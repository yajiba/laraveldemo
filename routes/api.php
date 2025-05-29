<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'list']);

    Route::get('/customer/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'get_customer_by_id']);

    Route::post('/customer/update/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'update_customer']);
    Route::post('/customer/create', [\App\Http\Controllers\Api\CustomerController::class, 'create_customer']);

});
