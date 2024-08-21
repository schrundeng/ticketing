<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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

