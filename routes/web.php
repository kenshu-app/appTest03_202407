<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 書籍
    Route::resource('books', App\Http\Controllers\BookController::class);
    // お気に入り
    Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index');
    Route::post('/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');
});

require __DIR__ . '/auth.php';
