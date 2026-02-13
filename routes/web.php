<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserAddressController;



Route::get('/', function () {
    return view('home');
})->name('home');

/* Route::get('/dashboard/{section}', function ($section){
    return view('admin.overview', ['section' => $section]);
}); */
Route::get('/dashboard/{section}', [AdminController::class, 'admin']);
Route::post('/addUser', [AdminController::class, 'addUser'])->name('addUser');
Route::get('/dashboard', function () {
    return view('admin.sidebar');
})->name('dashboard');


Route::get('/Products', [ProductController::class, 'index'])->name('Products');
Route::get('/Product/{id}', [ProductController::class, 'show'])->name('product details');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('Address',UserAddressController::class);
    Route::resource('CartItem',CartItemController::class);
    Route::resource('Order' ,OrderController::class);
    Route::get('/sell' ,function () { return view('product.sell');})->name('sell_product');
    /* Route::get('/cart', [CartItemController::class, 'index'])->name('cart'); */


});


require __DIR__.'/auth.php';
