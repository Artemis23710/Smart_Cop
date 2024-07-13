<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\RolemanageController;
use App\Http\Controllers\UsermanageController;
use App\Http\Controllers\HomeController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/permisionlist', [Admincontroller::class, 'permisiondetails'])->name('permisionlist');

// role mange controller routes
Route::get('/rolelists', [RolemanageController::class, 'index'])->name('rolelists');
Route::post('/insertrole', [RolemanageController::class, 'storeRole'])->name('insertrole');
Route::post('/editrole', [RolemanageController::class, 'edit'])->name('editrole');
Route::delete('/roledelete/{role}', [RolemanageController::class, 'destroy'])->name('roledelete');

// user manage controller routes
Route::get('/userdashbord', [UsermanageController::class, 'index'])->name('userdashbord');
Route::post('/storeuser', [UsermanageController::class, 'store'])->name('storeuser');
Route::post('/edituser', [UsermanageController::class, 'edit'])->name('edituser');
Route::get('/userstatus/{id}/{status}', [UsermanageController::class, 'status'])->name('userstatus');