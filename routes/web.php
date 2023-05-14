<?php

use App\Models\UserProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\DashboardReportController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardCustomerController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/aboutUs', [AboutUsController::class, 'index'])->name('aboutUs');
Route::get('/ourTeam', [OurTeamController::class, 'index'])->name('ourTeam');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('dashboard/product', DashboardProductController::class)->middleware('auth');
Route::resource('dashboard/order' , DashboardOrderController::class)->middleware('auth');
Route::get('dashboard/report', [DashboardReportController::class, 'index'])->name('dashboard.report')->middleware('auth');

Route::controller(DashboardCustomerController::class)->middleware('auth')->group(function () {
    Route::get('dashboard/customer', 'index')->name('dashboard.customer');
    Route::get('dashboard/customer/{user}', 'show')->name('dashboard.customer.show');
    Route::get('dashboard/customer/{user}/edit', 'edit')->name('dashboard.customer.edit');
    Route::patch('dashboard/customer/{user}', 'update')->name('dashboard.customer.update');
    Route::delete('dashboard/customer/{user}', 'destroy')->name('dashboard.customer.destroy');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('actionlogin', 'actionlogin')->name('actionlogin');
    Route::get('actionlogout', 'actionlogout')->name('actionlogout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('actionregister', 'actionregister')->name('actionregister');
});

Route::controller(UserProfileController::class)->middleware('auth')->group(function () {
    Route::get('userprofile', 'index')->name('user.profile');
    Route::get('/userdetailprofile', 'detailUser')->name('user.detail.profile');
    Route::patch('/userdetailprofile/{user}', 'updateDetailUser')->name('update.user.detail.profile');
    Route::post('actionuserprofile', 'actionUserProfile')->name('actionuserprofile');
});

Route::controller(CartController::class)->middleware('auth')->group(function () {
    Route::get('cart', 'index')->name('cart');
    Route::post('cart/add/{id}', 'add')->name('cart.add');
    Route::patch('update-cart/{id}', 'update')->name('cart.edit');
    Route::delete('remove-from-cart/{cart}', 'destroy')->name('cart.destroy');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('checkout/add', 'checkoutPost')->name('checkout.post');
    Route::patch('cart/{user}', 'updateDetailChekcout')->name('update.detail.checkout');
});