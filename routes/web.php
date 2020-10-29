<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/kayit-ol', [AuthController::class, 'register'])->name('register')->middleware('notLogin');
Route::post('/kayit-ol', [AuthController::class, 'register_post'])->name('register.post')->middleware('notLogin');
Route::get('/giris-yap', [AuthController::class, 'login'])->name('login')->middleware('notLogin');
Route::post('giris-yap', [AuthController::class, 'login_post'])->name('login.post')->middleware('notLogin');
Route::get('cikis', [AuthController::class, 'logout'])->name('logout');
Route::get('/maddeler', [HomeController::class, 'tasks'])->name('tasks')->middleware('isLogin');
Route::get('/madde-ekle', [HomeController::class, 'add_task'])->name('add.task')->middleware('isLogin');
Route::post('/madde-ekle', [HomeController::class, 'add_task_post'])->name('add.task.post')->middleware('isLogin');
Route::get('/madde-sil/{id}', [HomeController::class, 'delete_task'])->name('delete.task');
Route::get('/madde-duzenle/{id}', [HomeController::class, 'edit_task'])->name('edit.task');
Route::post('/madde-duzenle({id}', [HomeController::class, 'edit_task_post'])->name('edit.task.post')->middleware('isLogin');
Route::get('/madde-durum-degistir', [HomeController::class, 'switch'])->name('switch.task');
