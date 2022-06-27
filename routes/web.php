<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\RequestController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [FrontProductListController::class, 'index'])->name('welcome');
Route::get('/product/{product:slug}', [FrontProductListController::class, 'show'])->name('show-product')->missing(function (Request $request) {
    return Redirect::route('welcome');
});

// Socialite route
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

// Route::get('dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['prefix'=>'auth', 'middleware'=>['auth', 'isAdmin']], function () {
    Route::get('index', function () {
        return view('admin.dashboard');
    })->name('dashboard.admin');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('/booking', [CartController::class, 'userOrders'])->name('user.orders');
    Route::get('/booking/{userid}/{bookingid}', [CartController::class, 'viewUserOrders'])->name('view.user.orders');
    Route::post('/booking/{id}', [CartController::class, 'checkoutUpdate'])->name('checkout.update');

});

Route::get('/category/{category:slug}', [FrontProductListController::class, 'category'])->name('category');


Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Route::get('dashboard', function () {
    //     return view('dashboard');
    //     })->name('dashboard');

    // user dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')->group(function(){
       Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
    });

    // admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->group(function(){
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
     });

    Route::get('/addtocart/{product:slug}', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart-show');
    Route::post('/cart/{product:slug}', [CartController::class, 'updateCart'])->name('cart-update');
    Route::post('/cart/{product:slug}/delete', [CartController::class, 'removeCart'])->name('cart-remove');
    Route::get('/booking/{amount}', [CartController::class, 'booking'])->name('booking');
    Route::post('/charge', [CartController::class, 'charge'])->name('cart-charge');
    // Route::get('/booking', [CartController::class, 'order'])->name('order');
    Route::get('/booking', [BookingController::class, 'index'])->name('order');
    Route::delete('/booking/{id}', [CartController::class, 'destroy'])->name('order-destroy');

    Route::get('/payment', [CheckoutController::class, 'index'])->name('payment');

    Route::get('/request', [RequestController::class, 'index'])->name('request');


});




require __DIR__.'/auth.php';