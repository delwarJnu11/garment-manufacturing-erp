
<?php

use App\Http\Controllers\AccountTypesController;

// use App\Http\Controllers\Api\ProductController as ApiProductController;


use App\Http\Controllers\Api\OrderDetailsController;

use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\BomDetailsController;
use App\Http\Controllers\BuyerController;
// use App\Http\Controllers\CategoryAttributesController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CuttingController;
use App\Http\Controllers\FabricTypeController;
use App\Http\Controllers\HrmAttendanceListController;
use App\Http\Controllers\HrmDepartmentController;
use App\Http\Controllers\HrmDepartmentsController;
use App\Http\Controllers\HrmDesignationsController;
use App\Http\Controllers\HrmEmployeeBankAccountsController;
use App\Http\Controllers\HrmEmployeePerformancesController;
use App\Http\Controllers\HrmEmployeesController;
use App\Http\Controllers\HrmEmployeeTimesheetsController;
use App\Http\Controllers\HrmLeaveApplicationApproversController;
use App\Http\Controllers\HrmLeaveApplicationsController;
use App\Http\Controllers\HrmLeaveTypesController;
use App\Http\Controllers\HrmPayslipItemsController;
use App\Http\Controllers\HrmPayslipsController;
use App\Http\Controllers\HrmStatusesController;
use App\Http\Controllers\ProductionPlanStatusesController;
use App\Http\Controllers\HrmSubDepartmentsController;
use App\Http\Controllers\InvSuppliersController;
use App\Http\Controllers\MovementTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderStatusController;

use App\Http\Controllers\ProductionPlanController;
use App\Http\Controllers\ProductionWorkSectionController;
use App\Http\Controllers\ProductionWorkOrderController;
use App\Http\Controllers\ProductionWorkStatusController;
use App\Http\Controllers\ProductCatelogueController;
use App\Http\Controllers\ProductlotController;
use App\Http\Controllers\ProductTypeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;

use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuationMethodsController;
use App\Http\Controllers\WarehouseController;
use App\Models\Hrm_leave_types;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductType;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseStateController;
use App\Http\Controllers\SweingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasePaymentController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\StockAdjustmentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.dashboard-home');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard-home');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

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
Route::resource('production_work_sections', ProductionWorkSectionController::class);
Route::resource('production-work-status', ProductionWorkStatusController::class);
Route::resource('bom', BomController::class);
Route::resource('bom_details', BomDetailsController::class);
Route::resource('production-plans', ProductionPlanController::class);
Route::resource('production-work-orders', ProductionWorkOrderController::class);
Route::prefix('production-stages')->group(function () {
    Route::resource('cutting', CuttingController::class);
    Route::resource('sweing', SweingController::class);

    // Custom route for completed cuttings
    Route::get('cutting-completed', [CuttingController::class, 'completed'])->name('cutting.completed');
});


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

 Route::post('/hrm_attendance_list/clock-in', [HrmAttendanceListController::class, 'clockIn']);
 Route::post('/hrm_attendance_list/clock-out', [HrmAttendanceListController::class, 'clockOut']);
 Route::get('hrm_attendance_list/delete/{id}/', [HrmAttendanceListController::class, 'destroy']);
 Route::resource('hrm_attendance_list', HrmAttendanceListController::class);

 Route::get('hrm_employee_timesheets/delete/{id}/',[HrmEmployeeTimesheetsController::class,'destroy'] );
 Route::resource('hrm_employee_timesheets', HrmEmployeeTimesheetsController::class);

 Route::get('hrm_leave_types/delete/{id}/',[HrmLeaveTypesController::class,'destroy'] );
 Route::resource('hrm_leave_types', HrmLeaveTypesController::class);


 Route::post('/hrm_leave_applications/leaveUpdate', [HrmLeaveApplicationsController::class, 'leaveUpdate']);
 Route::get('hrm_leave_applications/delete/{id}/',[HrmLeaveApplicationsController::class,'destroy'] );
 Route::resource('hrm_leave_applications', HrmLeaveApplicationsController::class);


 Route::get('hrm_leave_application_approvers/delete/{id}/',[HrmLeaveApplicationApproversController::class,'destroy'] );
 Route::resource('hrm_leave_application_approvers', HrmLeaveApplicationApproversController::class);

 Route::get('hrm_payslips/delete/{id}/',[HrmPayslipsController::class,'destroy'] );
 Route::get('hrm_payslips/create/',[HrmPayslipsController::class,'create'] );
 Route::resource('hrm_payslips', HrmPayslipsController::class);

 Route::get('hrm_payslip_items/delete/{id}/',[HrmPayslipItemsController::class,'destroy'] );
 Route::resource('hrm_payslip_items', HrmPayslipItemsController::class);


 Route::get('find_employee', [HrmEmployeesController::class, 'find_employee']);
//  Route::get('find_payslip_items', [HrmEmployeesController::class, 'find_payslip_items']);


// Route::get('showpayslip', function(){
//     return view('pages.hrm.payroll.hrm_payslips.show');
// });

 // Route::get('/employee', function () {
 //     echo Auth::user()->isEmployee();
 // })->middleware(['employee']);

     Route::get('/home', function () {
         return view('home');
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

Route::resource('sizes', SizeController::class);


Route::prefix('stock')->group(function () {
    Route::resource('stock_adjustments', StockAdjustmentController::class);
    Route::resource('status', StatusController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product_lots', ProductlotController::class);
    Route::resource('categoryType', CategoryTypeController::class);
    Route::resource('raw_materials', RawMaterialController::class);
    Route::resource('product_types', ProductTypeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('productCatelogues', ProductCatelogueController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('stockMovements', StockMovementController::class);
    Route::resource('movementTypes', MovementTypeController::class);
});
// Route::resource('stock_adjustments', StockAdjustmentController::class);


/**
 * Warehouse
 **/


// Route::resource('productsApi', ApiProductController::class);


// Sales & buyers
Route::resource('buyers', BuyerController::class);
/**
 * Suppliers and Purcahse
 */
// sales invoice
Route::resource('sales-invoice', SalesInvoiceController::class);
Route::post('find_buyer', [SalesInvoiceController::class, 'find_buyer']);
Route::get('order/show', [SalesInvoiceController::class, 'show']);

Route::resource('suppliers', InvSuppliersController::class);
Route::resource('uoms', UOMController::class);

//adjusment

// Route::middleware('auth')->get('/stock-adjustment', [StockAdjustmentController::class, 'create']);

Route::resource('valuations', ValuationMethodsController::class);

Route::resource('purchase', PurchaseOrderController::class);
Route::get('/invoice/{id}/print', [PurchaseOrderController::class, 'print'])->name('invoice.print');
Route::get('purchase/{id}/generate-pdf', [PurchaseOrderController::class, 'generatePDF'])->name('purchase.generatePDF');

Route::post('/get-warehouse', [WarehouseController::class, 'getWarehouse'])->name('get.warehouse');
Route::post('find_supplier', [PurchaseOrderController::class, 'find_supplier']);
Route::post('find_product', [PurchaseOrderController::class, 'find_product']);
Route::get('/get-invoice-id', [PurchaseOrderController::class, 'getInvoiceId']);
// Route::get('/purchaseState', [PurchaseOrderController::class,])->name('purchaseState.index');
Route::get('/purchaseState', [PurchaseStateController::class, 'index'])->name('purchaseState.index');
Route::post('/purchase/updateStatus', [PurchaseOrderController::class, 'updateStatus'])->name('purchase.updateStatus');

// Report
Route::get('/purchase-report',[PurchaseReportController::class,'index']);
Route::post('/purchase-report',[PurchaseReportController::class,'show']);
// Report
Route::get('/purchase-report', [PurchaseReportController::class, 'index']);
Route::post('/purchase-report', [PurchaseReportController::class, 'show']);
// payment
Route::resource('payments', PurchasePaymentController::class);


/*
 *  Orders & Buyers
 */
Route::resource('orders', OrderController::class);
Route::resource('order_details', OrderDetailController::class);
Route::resource('colors', ColorController::class);
Route::resource('order_status', OrderStatusController::class);
Route::resource('fabric_types', FabricTypeController::class);


// Route::get('orders', [OrderDetailsController::class, 'index']);

// Route::get('orders', [OrderDetailsController::class, 'index']);
/**
 *END Invetory/category
 **/

Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
Route::resource('accountTypes', AccountTypesController::class);
// Route::resource('createAssetType', AssetTypesController::class);

require __DIR__ . '/auth.php';
