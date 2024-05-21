<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// Reset password
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

// Tampilan Website Sebelum Login
use App\Http\Controllers\PageController;
// Route untuk Halaman Utama Website JUKI http://127.0.0.1:8000/page
Route::get('juki', [PageController::class, 'index'])->name('juki.index');
// About Us http://127.0.0.1:8000/about
Route::get('/about', [PageController::class, 'about'])->name('about');
// Service http://127.0.0.1:8000/service
Route::get('/service', [PageController::class, 'service'])->name('service');

// Route untuk Cek Halaman Admin http://127.0.0.1:8000/admin
Route::get('admin', [PageController::class, 'admin'])->name('admin.dashboard');

// Autentikasi Middleware untuk Role Login User dan Admin
Route::prefix('page')->middleware('authentication')->group(function () {

    // Halaman Website JUKI
    Route::prefix('juki')->middleware('role:superadmin|user')->group(function () {
        Route::get('/', [PageController::class, 'juki'])->name('page.juki');
        // Halaman UMKM Muncul Setelah Login http://127.0.0.1:8000/umkm
        Route::get('/umkm', [PageController::class, 'viewUmkm'])->name('umkm');
        // Info Loker http://127.0.0.1:8000/info-loker
        Route::get('/info-loker', [PageController::class, 'infoLoker'])->name('info-loker');
        // Dasboard http://127.0.0.1:8000/dashboard
        Route::get('/dashboard', [PageController::class, 'addDashboard'])->name('dashboard');
        // Profil http://127.0.0.1:8000/profil
        Route::get('/profil', [PageController::class, 'addProfil'])->name('profil');
        // Loker http://127.0.0.1:8000/loker
        Route::get('/loker', [PageController::class, 'addLoker'])->name('loker');
        // Route::get('/add', [PageController::class, 'addProduct'])->name('page.juki.add');
        // Route::post('/store', [PageController::class, 'storeProduct'])->name('page.juki.store');
        // Route::get('/edit/{id}', [PageController::class, 'editProduct'])->name('page.juki.edit');
        // Route::put('/update/{id}', [PageController::class, 'updateProduct'])->name('page.juki.update');
        // Route::post('/delete/{id}', [PageController::class, 'deleteProduct'])->name('page.juki.delete');
        // Route::get('/export', [PageController::class, 'exportProduct'])->name('page.juki.export');
    });

    // Halaman Admin
    Route::prefix('admin')->middleware('role:superadmin')->group(function () {
        // http://127.0.0.1:8000/page/admin
        Route::get('/', [PageController::class, 'admin'])->name('page.admin');
        // http://127.0.0.1:8000/page/admin/users
        Route::get('/users', [PageController::class, 'users'])->name('page.admin.index');
        Route::get('/add', [PageController::class, 'addUser'])->name('page.admin.add');
        Route::post('/store', [PageController::class, 'storeUser'])->name('page.admin.store');
        Route::get('/edit/{id}', [PageController::class, 'editUser'])->name('page.admin.edit');
        Route::put('/update/{id}', [PageController::class, 'updateUser'])->name('page.admin.update');
        Route::post('/delete/{id}', [PageController::class, 'deleteUser'])->name('page.admin.delete');
    });

});