<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/account', [UserController::class, 'index'])->name('account')->middleware('auth');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('list');
    Route::get('/data', [UserController::class, 'getUsers'])->name('data');
    Route::get('/filter',[UserController::class,'getFiltes'])->name('filter');
    Route::get('/create',[UserController::class,'create'])->name('create');
    Route::post('/create',[UserController::class,'store'])->name('store');
    Route::get('/update/{user}',[UserController::class,'edit'])->name('edit');
    Route::post('/update/{user}',[UserController::class,'update'])->name('update');
})->middleware('auth');
require __DIR__ . '/auth.php';
