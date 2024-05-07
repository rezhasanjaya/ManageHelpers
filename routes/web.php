<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Master\PaketController;
use App\Http\Controllers\Master\ProviderController;
use App\Http\Controllers\Master\CustomersController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Customers
    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index'); 
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::put('/customers/update/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::get('/customers/edit/{id}', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::get('/customers/destroy/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');

    //Paket
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index'); 
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');
    Route::put('/paket/update/{id}', [PaketController::class, 'update'])->name('paket.update');
    Route::get('/paket/edit/{id}', [PaketController::class, 'edit'])->name('paket.edit');
    Route::get('/paket/destroy/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
    
    //Provider
    Route::get('/provider', [ProviderController::class, 'index'])->name('provider.index');
    Route::get('/provider/create', [ProviderController::class, 'create'])->name('provider.create');
    Route::post('/provider/store', [ProviderController::class, 'store'])->name('provider.store');
    Route::put('/provider/update/{id}', [ProviderController::class, 'update'])->name('provider.update');
    Route::get('/provider/edit/{id}', [ProviderController::class, 'edit'])->name('provider.edit');
    Route::get('/provider/destroy/{id}', [ProviderController::class, 'destroy'])->name('provider.destroy');

    //Billing
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/create', [BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/store', [BillingController::class, 'store'])->name('billing.store');
    Route::put('/billing/update/{id}', [BillingController::class, 'update'])->name('billing.update');
    Route::get('/billing/edit/{id}', [BillingController::class, 'edit'])->name('billing.edit');
    Route::get('/billing/payment/{id}', [BillingController::class, 'payment'])->name('billing.payment');
    Route::get('/billing/destroy/{id}', [BillingController::class, 'destroy'])->name('billing.destroy');

    //Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    // Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    // Route::put('/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    // Route::get('/pembayaran/edit/{id}', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::get('/pembayaran/destroy/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');    

    //Users
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
});
