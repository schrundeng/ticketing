<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\absenController;

Route::get('/getTicket', [TicketController::class, 'getTicket']);
Route::get('/getTicketId', [TicketController::class, 'getTicketId']);
Route::post('/addTicket', [TicketController::class, 'addTicket']);
Route::put('/updateTicket', [TicketController::class, 'updateTicket']);
Route::delete('/deleteTicket', [TicketController::class, 'deleteTicket']);

Route::get('/getCategory', [CategoryController::class, 'getCategory']);
Route::get('/getCategoryId', [CategoryController::class, 'getCategoryId']);
Route::post('/addCategory', [CategoryController::class, 'addCategory']); //butuh privilage operator & admin
Route::put('/upadateCategory', [CategoryController::class, 'upadateCategory']); //butuh privilage operator & admin
Route::delete('/deleteCategory', [CategoryController::class, 'deleteCategory']); //butuh privilage operator & admin

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

