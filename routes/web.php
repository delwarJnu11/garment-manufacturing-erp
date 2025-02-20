<?php

use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\AssetTypesController;
use App\Http\Controllers\CategoryAttributesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
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
Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
Route::get('/users/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/users/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/users/roles/store', [RoleController::class, 'store'])->name('roles.store');
/**
 * Users and Roles Memu END
 **/

/**
 * Invetory/category 
 **/
Route::resource('status', StatusController::class);
Route::resource('category_value', CategoryController::class);
Route::resource('categoryType', CategoryTypeController::class);


Route::get('check', function () {
    return view('pages.error.eror404');
});

Route::resource('category', CategoryAttributesController::class);
Route::resource('categoryTypes', CategoryTypeController::class);


/**
 *END Invetory/category 
 **/

Route::resource('assetRegister', AssetStatusController::class);
Route::resource('assetTypes', AssetTypesController::class);
// Route::resource('createAssetType', AssetTypesController::class);



require __DIR__ . '/auth.php';
