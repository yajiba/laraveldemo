<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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


    Route::get('/customers', [CustomerController::class, 'list'])->name('customers.list');
    Route::get('/customers/list', [CustomerController::class, 'customer_datatables'])->name('customers.datatables');

    Route::post('/customer/update', [CustomerController::class, 'update_customer'])->name('customers.update');


});

require __DIR__.'/auth.php';
