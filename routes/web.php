<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'ProsesLogin']);
    Route::get('/login', function () {
        // Jika pengguna mengakses /login, arahkan ke / (root)
        return redirect('/');
    })->name('login');

    Route::get('/register', [SesiController::class, 'register'])->name('register');
    // Route to process the registration form
    Route::post('/register', [SesiController::class, 'processRegister'])->name('register.proses');

    Route::get('/get-kabupaten-by-province/{provinceId}', [SesiController::class, 'getKabupatenByProvince']);
});

Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'Admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role == 'Murid') {
            return redirect('/murid/dashboard');
        } else {
            return redirect('/');
        }
    }
});

Route::middleware(['auth'])->group(function () {
// Redirect /admin/home to /admin/dashboard for all authenticated users

    Route::middleware(['userAkses:Admin'])->prefix('admin')->group(function () {
        // Define the /admin/dashboard route with the 'admin.dashboard' name
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // LIST USER
        Route::get('/list-user', [AdminController::class, 'ShowListUser'])->name('admin.listusers');
        Route::get('/edit-user/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/update-user/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/delete-user/{id}', [AdminController::class, 'destroy']);
        Route::get('/tambah-user', [AdminController::class, 'ShowTambahUser'])->name('admin.tambahuser');
        Route::post('/tambah-user', [AdminController::class, 'store'])->name('proses.admin.tambahuser');

        Route::get('/document-user', [DocumentController::class, 'ShowDocumentUser'])->name('admin.document.user');
        Route::get('/get-kabupaten-by-provinces/{provinceId}', [AdminController::class, 'getKabupatenByProvince']);

        Route::get('/logout', [SesiController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware(['userAkses:Murid'])->prefix('murid')->group(function () {
        // Define the /customer/dashboard route with the 'customer.dashboard' name
        Route::get('/dashboard', [MuridController::class, 'ShowDashboardMurid'])->name('murid.dashboard');
        Route::get('/profile', [MuridController::class, 'ShowProfile'])->name('murid.profile');
        Route::put('/update-photo', [MuridController::class, 'updatePhoto'])->name('update.photo');

        // Route::get('/dashboard-murid/{userId}', [MuridController::class, 'ShowDashboardMurid'])->name('murid.dashboard');
        Route::get('/download-pdf', [MuridController::class, 'downloadPdf'])->name('users.pdf');

        Route::get('/logout', [SesiController::class, 'logout'])->name('murid.logout');
    });
});
