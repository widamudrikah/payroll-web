<?php

use App\Http\Controllers\Bendahara\BendaharaController;
use App\Http\Controllers\Bendahara\BendaharaDashboard;
use App\Http\Controllers\Bendahara\ManageAttendanceController;
use App\Http\Controllers\Bendahara\ManageEmployeeController;
use App\Http\Controllers\Bendahara\PayRollController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDashboard;
use App\Http\Controllers\Employee\SalaryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\BendaharaMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

// Welcome
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Bendahara
Route::prefix('bendahara')->middleware(['auth', BendaharaMiddleware::class])->group(function() {
    Route::controller(BendaharaController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('bendahara.dashboard');
    });

    Route::controller(ManageEmployeeController::class)->group(function() {
        Route::get('/kelola/karyawan', 'index')->name('manage.employee.index');
        Route::get('/tambah/karyawan', 'create')->name('manage.employee.create');
        Route::post('/simpan/karyawan', 'store')->name('manage.employee.store');
        Route::get('/edit/karyawan/{id}', 'edit')->name('manage.employee.edit');
        Route::put('/update/karyawan/{id}', 'update')->name('manage.employee.update');
        Route::delete('/destroy/karyawan/{id}', 'destroy')->name('manage.employee.destroy');
    });

    Route::controller(ManageAttendanceController::class)->group(function() {
        Route::get('/kelola/absensi', 'index')->name('manage.attendance.index');
    });

    Route::controller(PayRollController::class)->group(function() {
        Route::get('/kelola/gaji', 'index')->name('manage.payroll.index');
    });
});

// Employee
Route::prefix('karyawan')->middleware('auth')->group(function() {
    Route::controller(EmployeeController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('employee.dashboard');
    });

    Route::controller(AttendanceController::class)->group(function() {
        Route::get('/presensi', 'index')->name('attendance.index');
        Route::post('/presensi/store', 'store')->name('attendance.store');
    });

    Route::controller(SalaryController::class)->group(function() {
        Route::get('/gaji', 'index')->name('salary.index');
        Route::get('/gaji/download/{id}', 'donwnloadPdf')->name('salary.download');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
