<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAddressController;



Route::get('/Products', [ProductController::class, 'index']);
Route::get('/Product/{id}', [ProductController::class, 'show'])->name('product details');
Route::get('/cart', [CartItemController::class, 'index'])->name('cart');


Route::get('/', function () {
    return view('home');
})->name('home');

/* Route::get('/cart', function () {
    return view('cart');
})->name('cart'); */

Route::get('/user', function () {
    return view('user');
})->name('user');

/* Route::get('/Products', function () {
    return view('products');
})->name('products'); */

/* Route::get('/Products?category=GPU', function () {
    return view('products');
});
Route::get('/Products?category=CPU', function () {
    return view('products');
});
Route::get('/Products?category=RAM', function () {
    return view('products');
});
Route::get('/Products?category=Motherboard', function () {
    return view('products');
});
Route::get('/Products?category=Peripherals', function () {
    return view('products');
}); */

Route::get('/Sell', function () {
    return view('sell');
})->name('sell');

Route::get('/SignIn', function () {
    return view('signin');
})->name('signin');

Route::get('/SignUp', function () {
    return view('signup');
})->name('signup');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('Address',UserAddressController::class);
    Route::resource('CartItem',CartItemController::class);
    Route::resource('Order' ,OrderController::class);
});

require __DIR__.'/auth.php';
