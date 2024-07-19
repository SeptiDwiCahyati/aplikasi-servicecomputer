<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ServisController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Customer Routes
Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'getCustomers'])->name('customers.index');
    Route::put('/update/{customer_id}', [CustomerController::class, 'updateCustomer'])->name('update_customer');
    Route::get('/edit/{customer_id}', [CustomerController::class, 'getCustomerById'])->name('edit_customer');
    Route::post('/add', [CustomerController::class, 'addCustomer'])->name('add_customer');
    Route::delete('/delete/{customer_id}', [CustomerController::class, 'deleteCustomer'])->name('delete_customer');
});

// Keluhan Routes
Route::prefix('keluhan')->group(function () {
    Route::get('/', [KeluhanController::class, 'index'])->name('keluhan.index');
    Route::post('/keluhan/check-customer-id', [KeluhanController::class, 'checkCustomerId'])->name('keluhan.checkCustomerId');

    Route::get('/tambah-data', [KeluhanController::class, 'addForm'])->name('keluhan.addForm');
    Route::post('/keluhan', [KeluhanController::class, 'addKeluhan'])->name('keluhan.store');
    Route::get('/{id}/edit', [KeluhanController::class, 'edit'])->name('keluhan.edit');
    Route::delete('/{id}', [KeluhanController::class, 'destroy'])->name('keluhan.destroy');
    Route::put('/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');
});

// Computer Routes
Route::prefix('computers')->group(function () {
    Route::get('/', [ComputerController::class, 'index'])->name('computers.index');
    Route::post('/', [ComputerController::class, 'addComputer'])->name('computers.add');
    Route::get('/{id_komputer}/edit', [ComputerController::class, 'editComputer'])->name('computers.edit');
    Route::get('/{id_komputer}', [ComputerController::class, 'getComputerById'])->name('computers.show');
    Route::put('/{id_komputer}', [ComputerController::class, 'updateComputer'])->name('computers.update');
    Route::delete('/{id_komputer}', [ComputerController::class, 'deleteComputer'])->name('computers.delete');
});

// Barang Routes
Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
});

// Servis Routes
Route::prefix('servis')->group(function () {
    Route::get('/', [ServisController::class, 'index'])->name('servis.index');
    Route::post('/', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/create', [ServisController::class, 'create'])->name('servis.create');
    Route::get('/{id}/edit', [ServisController::class, 'edit'])->name('servis.edit');
    Route::put('/{id}', [ServisController::class, 'update'])->name('servis.update');
    Route::delete('/{id}', [ServisController::class, 'destroy'])->name('servis.destroy');
    Route::get('/{id}', [ServisController::class, 'show'])->name('servis.show');
});
