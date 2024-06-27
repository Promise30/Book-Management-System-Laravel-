<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReadingStatusController;

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
//Book routes
// ->prefix("books")
Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('book.index');
    Route::post('/books/{book}/status', [ReadingStatusController::class, 'update'])->name('reading.update');
    Route::get('books/reading-dashboard', [ReadingStatusController::class, 'dashboard'])->name('reading.dashboard');
    Route::get('books/{book}', [BookController::class,'show'])->name('book.show');
}); 


// Review routes
Route::get('/books/{book}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
//Route::get('/books/{book}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
//Route::get('/books/{book}/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/books/{book}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/books/{book}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


// Category routes
Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
Route::get('/categories/{category}', [CategoryController::class,'show'])->name('category.show');
Route::post('/categories',  [CategoryController::class, 'store'])->name('category.store');
Route::put('/categories/{category}', [CategoryController::class,'update'])->name('category.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');



// Admin routes
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/books/{book}', [AdminController::class,'showBook'])->name('admin.show');
    //Route::get('/admin/users', [AdminController::class, 'users']);
    //Route::put('/admin/users/{id}', [AdminController::class, 'updateUser']);
    
    // Admin book management
    Route::get('/addBook', [BookController::class, 'create'])->name('book.create');
    Route::post('/books', [BookController::class,'store'])->name('book.store');
    Route::get('books/editBook/{book}', [BookController::class,'edit'])->name('book.edit');
    Route::patch('books/{book}', [BookController::class,'update'])->name('book.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    // Admin category management
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});

// Route::middleware(['auth'])->group(function () {
//     Route::post('/books/{book}/status', [ReadingStatusController::class, 'update'])->name('reading.update');
//     Route::get('books/reading-dashboard', [ReadingStatusController::class, 'dashboard'])->name('reading.dashboard');
// });

require __DIR__.'/auth.php';
