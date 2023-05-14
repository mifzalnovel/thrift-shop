<?php

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
use App\Http\Controllers\DashboardProductController;
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

Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'index')->name('cart');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('checkout/add', 'checkoutPost')->name('checkout.post');
    Route::get('cart/add/{id}', 'add')->name('cart.add');
    Route::delete('remove-from-cart', 'remove')->name('cart.remove');
    Route::patch('update-cart', 'update')->name('cart.update');
    // Route::post('/orders', 'store')->name('orders.store');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('dashboard/product', DashboardProductController::class);

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('actionlogin', 'actionlogin')->name('actionlogin');
    Route::get('actionlogout', 'actionlogout')->name('actionlogout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('actionregister', 'actionregister')->name('actionregister');
});

// Route::controller(DashboardController::class)->middleware('auth')->group(function () {
//     // Route Pemesanan Keluar dan Pemesanan Masuk Pemandu
//     Route::get('/dashboard', 'index')
//         ->name('pemesanan.pemandu');
//     Route::get('/dashboard/{pemesanan_pemandu:uuid}/terima', 'terima')
//         ->name('pemesanan.pemandu.terima');
//     Route::get('/dashboard/{pemesanan_pemandu:uuid}/tolak', 'tolak')
//         ->name('pemesanan.pemandu.tolak');
//     Route::get('/dashboard/{pemesanan_pemandu:uuid}/konfirmasi', 'konfirmasi')
//         ->name('pemesanan.pemandu.konfirmasi');
//     Route::get('/dashboard/{pemesanan_pemandu:uuid}/cancel', 'cancel')
//         ->name('pemesanan.pemandu.cancel');

//     // Route Detail Pemesanan Pemandu
//     Route::get('/dashboard/detail/{pemesanan_pemandu:id}', 'show')
//         ->name('pemesanan.pemandu.detail');

//     Route::get('/dashboard/{pemandu}/pesan', 'pesan')->name('pandu.pesan');
//     Route::post('/dashboard/{pemandu}/pesan', 'pesanSimpan')->name('pandu.pesan.simpan');
// });