<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\AdminCartItemController;
use App\Http\Controllers\ChekcoutController;
use App\Http\Controllers\ChecklistController;
use App\Models\User;

// Route untuk menampilkan halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk menampilkan detail transaksi
Route::get('/transaction', [ChecklistController::class, 'transaction'])->name('transaction');

// Route untuk cart
Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartItemController::class, 'addItem'])->name('cart.add');
Route::post('/cart/update/{id}', [CartItemController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartItemController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartItemController::class, 'clearCart'])->name('cart.clear');


// Route untuk login
Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Route untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// Route untuk register
Route::get('/register', [AuthController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// Route untuk menampilkan form verifikasi email
Route::get('/verification_email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

// Route untuk authentikasi pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Route untuk products
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    // Route untuk cart
    Route::get('/carts', [AdminCartItemController::class, 'index'])->name('carts.index');
    Route::delete('/carts/remove/{id}', [AdminCartItemController::class, 'remove'])->name('carts.remove');
    Route::get('/carts/edit/{id}', [AdminCartItemController::class, 'edit'])->name('carts.edit');
    Route::put('/carts/update/{id}', [AdminCartItemController::class, 'update'])->name('carts.update');
    Route::delete('/carts/{id}', [AdminCartItemController::class, 'destroy'])->name('carts.destroy');

    // Route untuk checkout
    Route::get('/orders', [ChecklistController::class, 'index'])->name('orders.index');
    Route::put('/orders/update/{id}', [ChecklistController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [ChecklistController::class, 'destroy'])->name('orders.destroy');
});

// Route untuk checkout
// Route::get('/checkout', [ChekcoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout{province}', [ChekcoutController::class, 'getRegencies'])->name('checkout.getRegencies');
// Route::post('/checkout{regency}', [ChekcoutController::class, 'getDistricts'])->name('checkout.getDistricts');

// Route untuk checkout
Route::get('/checkout', [ChekcoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/get-regencies', [ChekcoutController::class, 'getRegencies'])->name('checkout.getRegencies');
Route::post('/checkout/get-districts', [ChekcoutController::class, 'getDistricts'])->name('checkout.getDistricts');
// Route::post('/checkout/get-villages', [ChekcoutController::class, 'getVillages'])->name('checkout.getVillages');
Route::post('/checkout-ceklist', [ChekcoutController::class, 'store'])->name('checkout-ceklist.store');

// Route untuk menampilkan halaman checklist
Route::get('/order-checklist', [OrderController::class, 'index'])->name('checklist.index');
// Route::get('/order-checklist', [OrderController::class, 'index'])->name('checklist.index');


