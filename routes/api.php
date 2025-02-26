<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ComponenetController;
use App\Http\Controllers\Api\Auth\OperationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users',function(){
    return User::all();
});

Route::group(['namespace' => 'Api\Auth'],function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});


Route::get('/officers', [ComponenetController::class, 'officersList']);

Route::post('/operationsave', [OperationController::class, 'store']);
Route::get('/OperationList', [OperationController::class, 'operationlist']);
Route::post('/operationedit', [OperationController::class, 'edit']);
Route::post('/operationdelete', [OperationController::class, 'delete']);
Route::post('/operationupdate', [OperationController::class, 'update']);
Route::post('/operationdeletetarget', [OperationController::class, 'deletetarget']);
Route::post('/operationdeleteofficers', [OperationController::class, 'deleteofficers']);