<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController;
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

    Route::get('/accounts', [AccountController::class, 'accounts'])->name('accounts');
    Route::get('/accounts/list', [AccountController::class, 'account_datatables'])->name('accounts.datatables');
    Route::post('/account/update', [AccountController::class, 'update_account']);


});

require __DIR__.'/auth.php';
