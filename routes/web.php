<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::prefix('employee')->group(function () {
        Route::get('/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('admin.employee.show');
    });

    Route::get('/profile', [ProfileController::class, 'getProfileData'])->name('admin.profile.getProfileData');
    Route::put('/profile', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
});
