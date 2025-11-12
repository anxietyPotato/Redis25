<?php

use App\Http\Controllers\ProductsController;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductsController::class, 'index'])->name('home');

Route::view('/products','product_create');
Route::post('products/create',[ProductsController::class,'create']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/flash', [ProductsController::class, 'flash']);
