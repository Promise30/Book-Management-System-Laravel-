<?php

use App\Http\Controllers\BookController;
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
});
Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('book.index');
    Route::get('/addBook', [BookController::class, 'create'])->name('book.create');
    Route::post('/addNewBook', [BookController::class,'store'])->name('book.store');
    Route::get('/showBook/{book}', [BookController::class,'show'])->name('book.show');
    Route::get('/editBook/{book}', [BookController::class,'edit'])->name('book.edit');
    Route::patch('/updateBook/{book}', [BookController::class,'update'])->name('book.update');
    Route::delete('/deleteBook/{book}', [BookController::class, 'destroy'])->name('book.destroy');
});

require __DIR__.'/auth.php';
