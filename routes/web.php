<?php

use App\Http\Controllers\Bendahara\BendaharaController;
use App\Http\Controllers\Bendahara\BendaharaDashboard;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDashboard;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\BendaharaMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Welcome
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Bendahara
Route::prefix('bendahara')->middleware(['auth', BendaharaMiddleware::class])->group(function() {
    Route::controller(BendaharaController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('bendahara.dashboard');
    });
});

// Employee
Route::prefix('karyawan')->middleware('auth')->group(function() {
    Route::controller(EmployeeController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('employee.dashboard');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
