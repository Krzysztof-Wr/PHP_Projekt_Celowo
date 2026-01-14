<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use App\Http\Controllers\WorkDayController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth',])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return 'ADMIN PANEL';
})->middleware(['auth', 'role:admin']);

Route::get('/manager', function () {
    return 'MANAGER PANEL';
})->middleware(['auth', 'role:manager,admin']);

Route::get('/employee', function () {
    return 'EMPLOYEE PANEL';
})->middleware(['auth', 'role:employee,manager,admin']);

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/workdays', [WorkDayController::class, 'adminIndex'])->name('workdays.index');
    Route::post('/workdays/{workDay}/comment', [WorkDayController::class, 'comment'])->name('workdays.comment');


});

// EMPLOYEE
Route::middleware(['auth', 'role:employee,manager,admin'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/workdays', [WorkDayController::class, 'employeeIndex'])->name('workdays.index');
    Route::post('/workdays/{workDay}/comment', [WorkDayController::class, 'comment'])->name('workdays.comment');
});

// MANAGER/ADMIN: dodawanie godzin pracownikom
Route::middleware(['auth', 'role:manager,admin'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/workdays/create', [WorkDayController::class, 'managerCreate'])->name('workdays.create');
    Route::post('/workdays', [WorkDayController::class, 'managerStore'])->name('workdays.store');
});

require __DIR__.'/auth.php';
