
<?php

use App\Http\Controllers\AccountTypesController;

use App\Http\Controllers\Api\ProductController as ApiProductController;

use App\Http\Controllers\Api\OrderDetailsController;

use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CategoryAttributesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\FabricTypeController;
use App\Http\Controllers\HrmAttendanceListController;
use App\Http\Controllers\HrmDepartmentController;
use App\Http\Controllers\HrmDepartmentsController;
use App\Http\Controllers\HrmDesignationsController;
use App\Http\Controllers\HrmEmployeeBankAccountsController;
use App\Http\Controllers\HrmEmployeePerformancesController;
use App\Http\Controllers\HrmEmployeesController;
use App\Http\Controllers\HrmStatusesController;
use App\Http\Controllers\ProductionPlanStatusesController;
use App\Http\Controllers\HrmSubDepartmentsController;
use App\Http\Controllers\InvSuppliersController;
use App\Http\Controllers\MovementTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ProductCatelogueController;
use App\Http\Controllers\ProductlotController;
use App\Http\Controllers\ProductTypeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\Raw_materialController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuationMethodsController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\PurchaseStateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.dashboard-home');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard-home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Users and Roles Memu Start
 **/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/users/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/users/roles/store', [RoleController::class, 'store'])->name('roles.store');
/**
 * Users and Roles Memu END
 **/

/**
 * Production Memu START
 **/

Route::resource('production_plan_status', ProductionPlanStatusesController::class);

/**
 * Production Memu END
 **/

/**
 * Start Hr & Workforce Management.
 * Start Hr & Workforce Management.
 */

Route::get('hrm_status/delete/{id}', [HrmStatusesController::class, 'destroy']);
Route::resource('hrm_status', HrmStatusesController::class);

Route::get('hrm_departments/delete/{id}/', [HrmDepartmentsController::class, 'destroy']);
Route::resource('hrm_departments', HrmDepartmentsController::class);

Route::get('hrm_sub_departments/delete/{id}/', [HrmSubDepartmentsController::class, 'destroy']);
Route::resource('hrm_sub_departments', HrmSubDepartmentsController::class);

Route::get('hrm_designations/delete/{id}/', [HrmDesignationsController::class, 'destroy']);
Route::resource('hrm_designations', HrmDesignationsController::class);

Route::get('hrm_employees/delete/{id}/', [HrmEmployeesController::class, 'destroy']);
Route::resource('hrm_employees', HrmEmployeesController::class);

Route::get('hrm_employee_performances/delete/{id}/', [HrmEmployeePerformancesController::class, 'destroy']);
Route::resource('hrm_employee_performances', HrmEmployeePerformancesController::class);

Route::get('hrm_employee_bank_accounts/delete/{id}/', [HrmEmployeeBankAccountsController::class, 'destroy']);
Route::resource('hrm_employee_bank_accounts', HrmEmployeeBankAccountsController::class);

Route::get('hrm_attendance_list/delete/{id}/', [HrmAttendanceListController::class, 'destroy']);
Route::resource('hrm_attendance_list', HrmAttendanceListController::class);

Route::get('/route', function () {
    echo "hello";
});

/**
 * End Hr & Workforce Management.
 */



// End Route


/**
 * Company Profile
 */
Route::resource('companyProfile', CompanyProfileController::class);
/**
 * Invetory/category
 **/
Route::resource('status', StatusController::class);
Route::resource('category', CategoryController::class);
Route::resource('categoryType', CategoryTypeController::class);
Route::resource('raw_materials', Raw_materialController::class);
Route::resource('sizes', SizeController::class);

Route::resource('stockMovements', StockMovementController::class);
Route::resource('movementTypes', MovementTypeController::class);
/**
 * Warehouse
 **/
Route::resource('product_types', ProductTypeController::class);
Route::resource('products', ProductController::class);
Route::resource('stocks', StockController::class);
Route::resource('productCatelogues', ProductCatelogueController::class);
Route::resource('warehouses', WarehouseController::class);
// Route::resource('productsApi', ApiProductController::class);


// Sales & buyers
Route::resource('buyers', BuyerController::class);
/**
 * Suppliers and Purcahse
 */
Route::resource('suppliers', InvSuppliersController::class);
Route::resource('uoms', UOMController::class);

Route::resource('valuations', ValuationMethodsController::class);
Route::resource('product_lots', ProductlotController::class);
Route::resource('purchase', PurchaseOrderController::class);
Route::post('find_supplier', [PurchaseOrderController::class, 'find_supplier']);
Route::post('find_product', [PurchaseOrderController::class, 'find_product']);
Route::get('/get-invoice-id', [PurchaseOrderController::class, 'getInvoiceId']);
// Route::get('/purchaseState', [PurchaseOrderController::class,])->name('purchaseState.index');
Route::get('/purchaseState', [PurchaseStateController::class, 'index'])->name('purchaseState.index');
Route::post('/purchase/updateStatus', [PurchaseOrderController::class, 'updateStatus'])->name('purchase.updateStatus');

// Report 
Route::get('/purchase-report',[PurchaseReportController::class,'index']);
Route::post('/purchase-report',[PurchaseReportController::class,'show']);


/*
 *  Orders & Buyers
 */
Route::resource('orders', OrderController::class);
Route::resource('order_details', OrderDetailController::class);
Route::resource('colors', ColorController::class);
Route::resource('order_status', OrderStatusController::class);
Route::resource('fabric_types', FabricTypeController::class);


Route::get('orders', [OrderDetailsController::class, 'index']);
/**
 *END Invetory/category
 **/

Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
Route::resource('accountTypes', AccountTypesController::class);
// Route::resource('createAssetType', AssetTypesController::class);

require __DIR__ . '/auth.php';
