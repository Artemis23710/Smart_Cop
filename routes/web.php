<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\RolemanageController;
use App\Http\Controllers\UsermanageController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficerController;
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

//admin controller routes
Route::get('/permisionlist', [Admincontroller::class, 'index'])->name('permisionlist');
Route::get('/addpermision/{id}', [Admincontroller::class, 'addprivilegesview'])->name('addpermision');
Route::post('/saveprivilegies', [Admincontroller::class, 'updateprivilegies'])->name('saveprivilegies');



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

// Department Controller Routes
Route::get('/departmentdashboard', [DepartmentController::class, 'index'])->name('departmentdashboard');
Route::post('/officersearch', [DepartmentController::class, 'search'])->name('officersearch');
Route::get('/viewofficer/{id}', [DepartmentController::class, 'viewofficer'])->name('viewofficer');


// Division Controller Routes
Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions');
Route::get('/districts/{provinceId}', [DivisionController::class, 'getDistricts'])->name('districts');
Route::post('/divisionstore', [DivisionController::class, 'store'])->name('divisionstore');
Route::post('/divisionsedit', [DivisionController::class, 'edit'])->name('divisionsedit');
Route::get('/divisionsstatus/{id}/{status}', [DivisionController::class, 'status'])->name('divisionsstatus');

// Station Controller Routes
Route::get('/stations', [StationController::class, 'index'])->name('stations');
Route::post('/stationsstore', [StationController::class, 'store'])->name('stationsstore');
Route::post('/stationsedit', [StationController::class, 'edit'])->name('stationsedit');
Route::get('/stationsstatus/{id}/{status}', [StationController::class, 'status'])->name('stationsstatus');

// Officer Controller Routes
Route::get('/offiers', [OfficerController::class, 'index'])->name('offiers');
Route::get('/newoffiers', [OfficerController::class, 'newofficer'])->name('newoffiers');
Route::get('/showofficers', [OfficerController::class, 'showofficers'])->name('showofficers');
Route::get('/policestations/{divisionID}', [OfficerController::class, 'getpolicestation'])->name('policestations');
Route::post('/offiersstore', [OfficerController::class, 'store'])->name('offiersstore');
Route::get('/offieredit/{id}', [OfficerController::class, 'edit'])->name('offieredit');
Route::get('/offiersstatus/{id}/{status}', [OfficerController::class, 'status'])->name('offiersstatus');
Route::post('/checkidcardavalibility', [OfficerController::class, 'checkIdCard'])->name('checkidcardavalibility');
Route::post('/checkofficeridavalibility', [OfficerController::class, 'checkOfficerId'])->name('checkofficeridavalibility');
Route::post('/offierslogincreate', [OfficerController::class, 'createofficerlogin'])->name('offierslogincreate');
