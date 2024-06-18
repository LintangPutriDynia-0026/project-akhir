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
    return view('page.juki.home', ['navbar' => 'navbar1', 'footer' => 'footer']);
});

// Auth
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// Tampilan Website Sebelum Login
use App\Http\Controllers\PageController;
// Route untuk Halaman Utama Website JUKI http://127.0.0.1:8000/page
Route::get('juki', [PageController::class, 'index'])->name('juki.index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('admin', [PageController::class, 'admin'])->name('admin.dashboard');

// Autentikasi Middleware untuk Role Login User dan Admin
Route::prefix('page')->middleware('authentication')->group(function () {

    // Halaman Website JUKI
    Route::prefix('juki')->middleware('role:superadmin|user')->group(function () {
        Route::get('/', [PageController::class, 'juki'])->name('page.juki');
        Route::get('/umkm', [PageController::class, 'showUmkm'])->name('umkm');
        Route::get('/detailUmkm{id}', [PageController::class, 'detailUmkm'])->name('detailUmkm');
        Route::get('/searchUmkm', [PageController::class, 'searchUmkm'])->name('searchUmkm');
        Route::get('/searchLoker', [PageController::class, 'searchLoker'])->name('searchLoker');
        Route::get('/info-loker', [PageController::class, 'infoLoker'])->name('info-loker');
        Route::get('/detailLoker{id}', [PageController::class, 'detailLoker'])->name('detailLoker');
        // Route Manage UMKM
        Route::get('/dashboard', [PageController::class, 'showDashboard'])->name('dashboard');
        Route::post('/dashboard', [PageController::class, 'storeUmkm'])->name('umkm.store');
        Route::get('/editUmkm/{id}', [PageController::class, 'editUmkm'])->name('umkm.edit');
        Route::put('/updateUmkm/{id}', [PageController::class, 'updateUmkm'])->name('umkm.update');
        Route::post('/deleteUmkm/{id}', [PageController::class, 'destroyUmkm'])->name('umkm.destroy');
        // Route Manage Produk
        Route::get('/produk', [PageController::class, 'showProduk'])->name('produk');
        Route::get('/addProduk', [pageController::class, 'addProduk'])->name('produk.add');
        Route::post('/produk', [PageController::class, 'storeProduk'])->name('produk.store');
        Route::get('/editProduk/{id}', [PageController::class, 'editProduk'])->name('produk.edit');
        Route::put('/updateProduk/{id}', [PageController::class, 'updateProduk'])->name('produk.update');
        Route::post('/deleteProduk/{id}', [PageController::class, 'destroyProduk'])->name('produk.destroy');
        Route::get('/datatableProduk', [PageController::class, 'datatableProduk'])->name('datatableProduk');
        // Route Manage Profile
        Route::get('/profil', [PageController::class, 'showProfil'])->name('profil');
        Route::post('/updateProfil', [PageController::class, 'updateProfil'])->name('profil.update');
        // Route Manage Loker
        Route::get('/loker', [PageController::class, 'showLoker'])->name('loker');
        Route::post('/loker', [PageController::class, 'storeLoker'])->name('loker.store');
        Route::get('/editLoker/{id}', [PageController::class, 'editLoker'])->name('loker.edit');
        Route::put('/updateLoker/{id}', [PageController::class, 'updateLoker'])->name('loker.update');
        Route::post('/deleteLoker/{id}', [PageController::class, 'destroyLoker'])->name('loker.destroy');
        // Route::get('/detailUmkm{id}', [PageController::class, 'produkResource'])->name('produkResource');

        Route::post('/post/{post}/comment', [PageController::class, 'commentStore'])->name('comment.store');
        Route::delete('/comment/{comment}', [PageController::class, 'destroyComment'])->name('comment.delete');
        Route::post('/posts/{post}/comments/{parentComment?}', [PageController::class, 'commentStore'])->name('comment.store');
        Route::post('/like', [PageController::class, 'like'])->name('like');
    });

    // Halaman Admin
    Route::prefix('admin')->middleware('role:superadmin')->group(function () {
        // http://127.0.0.1:8000/page/admin
        // Route::get('/', [PageController::class, 'admin'])->name('page.admin.dashboard');
        // Route Manage User
        // http://127.0.0.1:8000/page/admin/users
        Route::get('/', [PageController::class, 'users'])->name('page.admin.index');
        Route::get('/add', [PageController::class, 'addUser'])->name('page.admin.add');
        Route::post('/store', [PageController::class, 'storeUser'])->name('page.admin.store');
        Route::get('/edit/{id}', [PageController::class, 'editUser'])->name('page.admin.edit');
        Route::put('/update/{id}', [PageController::class, 'updateUser'])->name('page.admin.update');
        Route::post('/delete/{id}', [PageController::class, 'deleteUser'])->name('page.admin.delete');
        Route::get('/datatableUser', [PageController::class, 'datatableUser'])->name('datatableUser');
        // Route Manage UMKM
        Route::get('/listUmkm', [PageController::class, 'listUmkm'])->name('page.admin.listUmkm');
        Route::get('/addUmkmUser', [PageController::class, 'addUmkmUser'])->name('page.admin.addUmkm');
        Route::post('/storeUmkmUser', [PageController::class, 'storeUmkmUser'])->name('page.admin.storeUmkm');
        Route::get('/editUmkmUser/{id}', [PageController::class, 'editUmkmUser'])->name('page.admin.editUmkm');
        Route::put('/updateUmkmUser/{id}', [PageController::class, 'updateUmkmUser'])->name('page.admin.updateUmkm');
        Route::post('/deleteUmkmUser/{id}', [PageController::class, 'deleteUmkmUser'])->name('page.admin.deleteUmkm');
        Route::get('/datatableUmkm', [PageController::class, 'datatableUmkm'])->name('datatableUmkm');
        // Route Manage Loker
        Route::get('/listLoker', [PageController::class, 'listLoker'])->name('page.admin.listLoker');
        Route::get('/addLokerUser', [PageController::class, 'addLokerUser'])->name('page.admin.addLoker');
        Route::post('/storeLokerUser', [PageController::class, 'storeLokerUser'])->name('page.admin.storeLoker');
        Route::get('/editLokerUser/{id}', [PageController::class, 'editLokerUser'])->name('page.admin.editLoker');
        Route::put('/updateLokerUser/{id}', [PageController::class, 'updateLokerUser'])->name('page.admin.updateLoker');
        Route::post('/deleteLokerUser/{id}', [PageController::class, 'deleteLokerUser'])->name('page.admin.deleteLoker');
        Route::get('/datatableLoker', [PageController::class, 'datatableLoker'])->name('datatableLoker');
    });
});