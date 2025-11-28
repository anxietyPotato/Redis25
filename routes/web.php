<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;
use App\Models\User;
use Illuminate\Support\Facades\Cache;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/change-avatar', [ProfileController::class, 'changeAvatar'])->name('profile.changeAvatar');
});

require __DIR__.'/auth.php';




Route::get('/', [ProductsController::class, 'index'])->name('home');

Route::view('/products','product_create');
Route::post('products/create',[ProductsController::class,'create']);
Auth::routes();







Route::get('/product/flash', [ProductsController::class, 'flash']);
