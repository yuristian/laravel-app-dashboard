<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\RoleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

});

Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/type','AllType')->name('all.type');
        Route::get('/add/type','AddType')->name('add.type');
        Route::post('/store/type','StoreType')->name('store.type');
        Route::get('/edit/type/{id}','EditType')->name('edit.type');
        Route::post('/update/type','UpdateType')->name('update.type');
        Route::get('/delete/type/{id}','DeleteType')->name('delete.type');

        Route::get('/all/amenity','AllAmenity')->name('all.amenity');
        Route::get('/add/amenity','AddAmenity')->name('add.amenity');
        Route::post('/store/amenity','StoreAmenity')->name('store.amenity');
        Route::get('/edit/amenity/{id}','EditAmenity')->name('edit.amenity');
        Route::post('/update/amenity','UpdateAmenity')->name('update.amenity');
        Route::get('/delete/amenity/{id}','DeleteAmenity')->name('delete.amenity');
    });

    Route::controller(RoleController::class)->group(function(){
        //Permission All Route
        Route::get('/all/permission','AllPermission')->name('all.permission');
        Route::get('/add/permission','AddPermission')->name('add.permission');
        Route::post('/store/permission','StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
        Route::post('/update/permission','UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');
        Route::get('/import/permission','ImportPermission')->name('import.permission');
        Route::get('export','Export')->name('export');
        Route::post('import','Import')->name('import');

        //Roles All Route
        Route::get('/all/role','AllRole')->name('all.role');
        Route::get('/add/role','AddRole')->name('add.role');
        Route::post('/store/role','StoreRole')->name('store.role');
        Route::get('/edit/role/{id}','EditRole')->name('edit.role');
        Route::post('/update/role','UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}','DeleteRole')->name('delete.role');

        Route::get('/all/role/permission','AllRolePermission')->name('all.role.permission');
        Route::get('/add/role/permission','AddRolePermission')->name('add.role.permission');
        Route::post('/store/role/permission','StoreRolePermission')->name('store.role.permission');

        Route::get('/admin/edit/role/{id}','AdminEditRole')->name('admin.edit.role');
        Route::post('/admin/update/role/{id}','AdminUpdateRole')->name('admin.update.role');
        Route::get('/admin/delete/role/{id}','AdminDeleteRole')->name('admin.delete.role');

    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/admin','AllAdmin')->name('all.admin');
        Route::get('/add/admin','AddAdmin')->name('add.admin');
        Route::post('/store/admin','StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
    });
}); //End Group Admin Middleware
