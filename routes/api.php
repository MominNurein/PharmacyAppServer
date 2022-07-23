<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SocketController;

// Users routes .
Route::get('/users', [UserController::class , 'index'])->name('allUsers');
Route::get('/users/{id}', [UserController::class , 'show'])->name('oneUser');
Route::post('/users', [UserController::class , 'store'])->name('createUser');
Route::delete('/users/{id}', [UserController::class , 'destroy'])->name('deleteUser');

// Pharmacy routes
Route::get('/pharmacies', [PharmacyController::class , 'index'])->name('allPharmacies');
Route::get('/pharmacies/{id}', [PharmacyController::class , 'show'])->name('onePharmacy');
Route::post('/pharmacies/{id}', [PharmacyController::class , 'store'])->name('createPharmacy');
Route::delete('/pharmacies/{id}', [PharmacyController::class , 'destroy'])->name('deletePharmacy');

// Products routes
Route::get('/products', [ProductController::class , 'index'])->name('allProducts');
Route::get('/products/{id}', [ProductController::class , 'show'])->name('oneProducts');
Route::post('/products', [ProductController::class , 'store'])->name('createProducts');
Route::delete('/products/{id}', [ProductController::class , 'destroy'])->name('deleteProducts');

// Order routes
Route::get('/orders', [OrderController::class , 'index'])->name('allOrders');
Route::get('/orders/{id}', [OrderController::class , 'show'])->name('oneOrder');
Route::post('/orders', [OrderController::class , 'store'])->name('createOrder');
Route::delete('/orders/{id}', [OrderController::class , 'destroy'])->name('deleteOrder');

// Delivery routes
Route::get('/delivery', [DeliveryController::class , 'index'])->name('allDeliveries');
Route::post('/delivery', [DeliveryController::class , 'store'])->name('createDelivery');
Route::put('/delivery/{id}', [DeliveryController::class , 'update'])->name('updateDelivery');
Route::get('/delivery/getlocation/{id}', [DeliveryController::class , 'getLocation']);
Route::post('/delivery/updatelocation/{id}' , [DeliveryController::class , 'updateLocation']);

// Testing Socket 
Route::get('/location/{id}', [SocketController::class , 'getLocation']);
Route::post('/location/{deliveryId}',[SocketController::class , 'setLocation']);

// Cart routes
Route::get('/cart', [CartController::class , 'index'])->name('allCarts');
Route::get('/cart/{id}', [CartController::class , 'show'])->name('oneCart');
Route::post('/cart', [CartController::class , 'store'])->name('createCart');
Route::delete('cart/{id}',[CartController::class , 'destroy']) -> name('deleteCart');