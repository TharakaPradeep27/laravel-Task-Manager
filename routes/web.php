<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;


Route::get('/', [AuthController::class , 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class , 'register'])->name('register.store');
Route::get('/login', [AuthController::class , 'showlogin'])->name('login.form');
Route::post('/login', [AuthController::class , 'login'])->name('login.check');
Route::get('/admindashboard', [AuthController::class, 'admindashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/userdashboard', [TaskController::class, 'showTask'])->name('user.dashboard')->middleware('auth');
Route::post('/add', [TaskController::class, 'add'])->name('task.add')->middleware('auth');
Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit')->middleware('auth');
Route::put('/task/update/{id}', [TaskController::class, 'update'])->name('task.update')->middleware('auth');
Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
