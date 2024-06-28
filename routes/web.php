<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');



Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->name('dashboard')->middleware(['auth', 'is_admin_emp']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Route Users 
 * Resource
 * GET (index , show , create , edit )  / POST (store) / DELETE (destroy) / PUT (update)
 * */ 
Route::resource('users', userController::class);

/**
 * Route Roles
 * index : return list of all roles
 * create : return form view of create new role
 * store : insert new role
 * revoke and assgin permission role form/to role
 * destroy : delete role
 */

Route::get('roles', [RoleController::class , 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}/assign-permission/{id}', [RoleController::class, 'assignPermission'])->name('role.assign-permission');
Route::put('/roles/{role}/revoke-permission/{id}', [RoleController::class, 'revokePermission'])->name('role.revoke-permission');
Route::delete('roles/{id}' , [RoleController::class, 'destroy'])->name('roles.delete');
