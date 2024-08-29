<?php

use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

// Route::controller(TestingController::class)->group(function () {
//     Route::get('/', 'getData');
//     Route::get('/id/{id}', 'getDataId'); 
// });
Route::get('/', function () {
    return view('welcome');
});