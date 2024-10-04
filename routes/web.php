<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QrAbsenController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        // total user
        $total_user = \App\Models\User::count();
        return view('pages.dashboard', ['type_menu' => 'home'], compact('total_user'));
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('qr_absen', QrAbsenController::class);
    Route::get('/qr-absen/{id}/download', [QrAbsenController::class, 'downloadPDF'])->name('qr_absen.download');
});
