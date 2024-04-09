<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BoardController::class, 'index'])->name('boards.index');

Route::middleware(['auth'])->group(function () {
  Route::resource('boards', BoardController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::resource('boards', BoardController::class)->only(['index', 'show']);

Route::middleware(['auth'])->post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
Route::middleware(['auth'])->resource('comments', CommentController::class)->only(['store', 'destroy']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
