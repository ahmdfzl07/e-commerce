<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostumersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CostumerRegistriController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FullCustomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Ecommerce\FrontController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\OrderController as EcommerceOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Models\OrderDetail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/produk', [FrontController::class, 'product'])->name('front.product');
Route::get('/full_custom', [FrontController::class, 'full_custom'])->name('front.full_custom');
Route::get('/category/{slug}', [FrontController::class,'categoryProduct'])->name('front.category');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('front.show_product');
Route::post('/register-admin', [CostumerRegistriController::class, 'createadmin'])->name('registeAdm.post');

Route::get('/login-admin', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/proses_login', 'App\Http\Controllers\Auth\LoginController@proses_login')->name('proses_login');
Route::post('/logout-admin', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/contact', function () {
    return view('costumer.contact');
});

Route::get('/coba', function () {
    return view('costumer.cart');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    /* route product */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('auth/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('create/product', [ProductController::class, 'create'])->name('product.create');
    Route::post('create/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{product_id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/{product_id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/users-second-db', [ProductController::class, 'getUsers']);

    Route::get('product/bulk', [ProductController::class, 'massUploadForm'])->name('product.bulk');
    Route::post('product/bulk', [ProductController::class, 'massUpload'])->name('product.saveBulk');

    /* route kategori */
    Route::get('kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::post('kategori', [CategoryController::class, 'store'])->name('category.store');
    Route::get('kategori/{category_id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('kategori/{category_id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('kategori/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    /* Order */
    Route::get('order/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('laporan/index', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('order', [OrderController::class, 'viewOrder'])->name('report.order');
    Route::get('order/pdf/{daterange}', [OrderController::class, 'orderReportPdf'])->name('report.order_pdf');
    /* Order */

    Route::get('full_custom/index', [FullCustomController::class, 'full_custom'])->name('order.full_custom');
    Route::post('full_custom/update/{id}', [FullCustomController::class, 'updateFC'])->name('full_custom.update');
    Route::delete('full_custom/destroy/{id}', [FullCustomController::class, 'destroy'])->name('full_custom.destroy');
    Route::get('full_custom', [FullCustomController::class, 'viewOrder'])->name('report.full_custom');
    Route::get('full_custom/pdf/{daterange}', [FullCustomController::class, 'orderReportPdf'])->name('report.order_pdf');
    Route::get('full_custom/pdf/{daterange}', [FullCustomController::class, 'orderReportPdf'])->name('report.order_pdf');
});

/* costumer login & register */
Route::prefix('/costumer')->name('costumer.')->namespace('Costumer')->group(function(){
    Route::get('/login', [CostumersController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CostumersController::class, 'login'])->name('login.post');
    Route::post('/logout-customer', [CostumersController::class, 'logout'])->name('customer-logout');
    Route::get('/register', [CostumerRegistriController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CostumerRegistriController::class, 'createCostumer'])->name('register.post');
});

/* costumer after login */
Route::group(['middelware' => 'costumer'], function () {
    Route::get('/costumer/profile', [CostumersController::class, 'editProfileAndPassword'])->name('costumer.profile');
    Route::put('/costumer/update-profile', [CostumersController::class, 'updateProfile'])->name('costumer.updateProfile');
    Route::put('/costumer/update-password', [CostumersController::class, 'updatePassword'])->name('costumer.updatePassword');

    Route::get('/costumer/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/costumer/produk', [HomeController::class, 'product'])->name('home.product');
    Route::get('/costumer/category/{slug}', [HomeController::class,'categoryProduct'])->name('home.category');
    Route::get('/costumer/product/{slug}', [HomeController::class, 'show'])->name('home.show_product');
    Route::get('/costumer/search', [HomeController::class, 'cari'])->name('product.search');

    Route::get('/costumer/cart', [CartController::class, 'index'])->name('home.list_cart');
    Route::get('/costumer/checkout', [EcommerceOrderController::class, 'checkout'])->name('home.checkout');
    Route::post('/costumer/checkout', [EcommerceOrderController::class, 'processCheckout'])->name('home.checkoutproses');
    // Route::post('/costumer/ongkir', [CartController::class, 'check_ongkir'])->name('home.cekongkir');
    Route::post('/costumer/cartadd', [CartController::class, 'addToCart'])->name('home.addcart');
    Route::patch('/costumer/cartupdate/{cart}', [CartController::class, 'updateCart'])->name('home.update_cart');
    Route::delete('/costumert/cart/delete/{id}', [CartController::class, 'destroy']);

    Route::get('/costumer/order/{invoice}', [EcommerceOrderController::class, 'index'])->name('home.order');
    Route::get('/costumer/order-detail', [EcommerceOrderController::class, 'detail'])->name('home.orderdetail');
    Route::get('/costumer/payment/{invoice}', [EcommerceOrderController::class, 'paymentForm'])->name('home.payment-form');
    Route::post('/costumer/payment/{invoice}', [EcommerceOrderController::class, 'payment'])->name('home.payment');
    Route::post('/costummer/order/update/{id}', [EcommerceOrderController::class, 'update'])->name('home.order.update');
    Route::get('/costumer/pdf/{id}', [EcommerceOrderController::class, 'generatepdf'])->name('home.pdf');

    // Route::get('/costumer/create', [CartController::class, 'coba'])->name('home.coba');

    // fullcustom 
    Route::get('/costumer/full_custom', [FullCustomController::class, 'list'])->name('home.full_custom');
    Route::post('/checkoutProsesCustom', [FullCustomController::class, 'checkoutProsesCustom'])->name('home.checkoutProsesCustom');
    Route::get('/costumer/full_custom/detail/{id}', [FullCustomController::class, 'show'])->name('full_custom.show');
    Route::get('/costumer/payment/fc/{id}', [FullCustomController::class, 'payment'])->name('home.payment-fc-form');
    Route::post('/costumer/payment/fullcustom/{id}', [FullCustomController::class, 'pay'])->name('pay-fc');
    Route::post('/costumerfull_custom/update/{id}', [FullCustomController::class, 'updateFC'])->name('full_custom.update.cust');

    Route::get('/cities/{id}', [CartController::class, 'getCity']);

});
