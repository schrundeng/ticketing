<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\absenController;

//API Route Collection for Authentication Taken from AuthController Controller
Route::middleware('auth:user_model')->group(function () {
        Route::post('logoutUser', [AuthController::class, 'logoutUser']);
        Route::get('getDataUser', [UserController::class, 'getData']);
});

Route::middleware('auth:pengelola_model')->group(function () {
        Route::patch('logoutPengelola', [AuthController::class, 'logoutPengelola']);
        Route::get('getDataPengelola', [PengelolaController::class, 'getData']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('registerUser', 'registerUser');
    Route::post('registerPemimpin', 'registerPemimpin');
    Route::post('registerOperator', 'registerOperator');
    Route::post('registerAdmin', 'registerAdmin');
    Route::post('refreshUser', 'refreshUser');
    Route::post('refreshPengelola', 'refreshPengelola');
    Route::post('loginUser', 'loginUser');
    Route::post('loginPengelola', 'loginPengelola');
}); 

Route::controller(absenController::class)->group(function (){
    Route::post('tesAbsen', 'tesAbsen');
});

// Route::post('login', [AuthController::class, 'login']);
// Route::middleware('auth:api')->get('user', [AuthController::class, 'me']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:user_model');

Route::get('/pengelola', function (Request $request) {
    return $request->user();
})->middleware('auth:pengelola_model');

