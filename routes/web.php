<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'getCustomers'])->name('customers.index');
    Route::put('/update/{customer_id}', [CustomerController::class, 'updateCustomer'])->name('update_customer');
    Route::get('/edit/{customer_id}', [CustomerController::class, 'getCustomerById'])->name('edit_customer');
    Route::post('/add', [CustomerController::class, 'addCustomer'])->name('add_customer');
    Route::delete('/delete/{customer_id}', [CustomerController::class, 'deleteCustomer'])->name('delete_customer');
});



Route::prefix('keluhan')->group(function () {
    Route::get('/', [KeluhanController::class, 'index'])->name('keluhan.index');
    Route::post('/cek-customer-id', [KeluhanController::class, 'checkCustomerId'])->name('keluhan.checkCustomerId');
    Route::get('/tambah-data', [KeluhanController::class, 'addForm'])->name('keluhan.addForm');
    Route::post('/keluhan', [KeluhanController::class, 'addKeluhan'])->name('keluhan.store');
    Route::get('/{id}/edit', [KeluhanController::class, 'edit'])->name('keluhan.edit');
    Route::delete('/{id}', [KeluhanController::class, 'destroy'])->name('keluhan.destroy');
    Route::put('/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');
});

Route::get('/computers', [ComputerController::class, 'index'])->name('computers.index');
Route::post('/computers', [ComputerController::class, 'addComputer'])->name('computers.add');
Route::get('/computers/{id_komputer}/edit', [ComputerController::class, 'editComputer'])->name('computers.edit');
Route::get('/computers/{id_komputer}', [ComputerController::class, 'getComputerById'])->name('computers.show');
Route::put('/computers/{id_komputer}', [ComputerController::class, 'updateComputer'])->name('computers.update');
Route::delete('/computers/{id_komputer}', [ComputerController::class, 'deleteComputer'])->name('computers.delete');

