<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['prefix'=>'user'],function(){
    Route::get('/signup', [UserController::class, 'create'])->name('signup');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/', [UserController::class, 'store'])->name('storeUser');
    Route::post('/register-user', [UserController::class, 'store'])->name('storeUser');
    Route::post('/', [UserController::class, 'loggedin'])->name('loginUser');


    Route::get('change-password/', [UserController::class, 'password'])->name('changePassword');
    Route::post('/password-changed', [UserController::class, 'resetpassword'])->name('resetPassword');


    Route::get('/reset-password', [UserController::class, 'forgetpassword'])->name('forgetPassword');
    Route::post('/pw-reset-link-sent', [UserController::class, 'forget'])->name('passwordReset');
    Route::get('/reset-pw-here/{token}', [UserController::class, 'reset'])->name('passwordResetting');
    Route::post('/reset-pw-here/{token}', [UserController::class, 'rreset'])->name('passwordResetDone');

});

Route::group(['prefix' => 'products', 'middleware' => 'auth.user'], function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('products');
    Route::get('/description/{product}', [ProductController::class, 'show'])->name('showProducts');
    Route::get('/search', [ProductController::class, 'search'])->name('searchProducts');
    Route::get('/refresh', [ProductController::class, 'reset'])->name('refreshProducts');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('editProducts');
    Route::put('/edit/{product}', [ProductController::class, 'update'])->name('updateProducts');
    Route::get('/create', [ProductController::class, 'create'])->name('createProducts');
    Route::get('/archive-products', [ProductController::class, 'archive'])->name('archiveProducts');
    Route::get('/unarchive-products{product}', [ProductController::class, 'unarchive'])->name('unarchiveProducts');
    Route::post('/', [ProductController::class, 'store'])->name('storeProducts');
    Route::get('/deleted/{product}', [ProductController::class, 'destroy'])->name('deleteProducts');
    Route::get('/removed/{product}', [ProductController::class, 'delete'])->name('delarchiveProducts');
});

Route::group(['prefix' => 'orders', 'middleware' => 'auth.user'], function () {
    Route::get('/dashboard', [OrderController::class, 'details'])->name('orderDetails'); 
    Route::get('/orders/{order}', [OrderController::class, 'sendEmail'])->name('sendEmail');
});


// Route::group(['middleware' => 'auth.user', 'prefix' => 'products'], function () {
//     Route::get('/dashboard', [ProductController::class, 'index'])->name('products');
//     Route::get('/description/{product}', [ProductController::class, 'show'])->name('showProducts');
//     Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('editProducts');
//     Route::put('/edit/{product}', [ProductController::class, 'update'])->name('updateProducts');
//     Route::get('/create', [ProductController::class, 'create'])->name('createProducts');
//     Route::post('/', [ProductController::class, 'store'])->name('storeProducts');
//     Route::delete('/deleted/{product}', [ProductController::class, 'destroy'])->name('deleteProducts');
// });