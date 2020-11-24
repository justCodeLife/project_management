<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::group([
    'middleware' => 'jwt',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/total_hours_of_work_per_project/{id}', [UserController::class, 'total_hours_of_work_per_project'])->where('id', '[0-9]+');
    Route::get('/total_hours_of_work_per_day', [UserController::class, 'total_hours_of_work_per_day']);
    Route::get('/total_hours_of_work_per_month', [UserController::class, 'total_hours_of_work_per_month']);
});
