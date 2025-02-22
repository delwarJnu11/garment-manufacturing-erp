<?php

use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\CategoryAttributesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\HrmDepartmentController;
use App\Http\Controllers\HrmDepartmentsController;
use App\Http\Controllers\HrmStatusController;
use App\Http\Controllers\HrmStatusesController;
use App\Http\Controllers\ProductionPlanStatusesController;
use App\Http\Controllers\HrmSubDepartmentController;
use App\Http\Controllers\InvSuppliersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuationMethodsController;
use App\Models\Category_type;
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
/**
 * Start Hr & Workforce Management.
 */

Route::get('hrm_status/delete/{id}', [HrmStatusesController::class, 'destroy']);
Route::resource('hrm_status', HrmStatusesController::class);

// Route::get('hrm_status', function(){
//     echo "hello hrm_status";
// });

// End Route

/**
 * Invetory/category
 **/
/**
 * Company Profile
 */
Route::resource('companyProfile', CompanyProfileController::class);

Route::resource('status', StatusController::class);
Route::resource('category_list', CategoryController::class);
Route::resource('categoryType', CategoryTypeController::class);



Route::get('check', function () {
    return view('pages.error.eror404');
});

Route::resource('category', CategoryAttributesController::class);
Route::resource('categoryTypes', CategoryTypeController::class);


/**
 * Suppliers and Purcahse
 */
Route::resource('suppliers', InvSuppliersController::class);
Route::resource('uoms', UOMController::class);
Route::resource('products', ProductController::class);
Route::resource('valuations', ValuationMethodsController::class);
/**
 *END Invetory/category
 **/

Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
// Route::resource('createAssetType', AssetTypesController::class);

require __DIR__ . '/auth.php';
