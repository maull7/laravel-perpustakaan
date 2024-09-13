<?php

use GuzzleHttp\Middleware;
use App\Models\TransactionBook;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LendingsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionBooksController;


Auth::routes();

Route::get('/', [MemberController::class, 'member'])->name('home');
Route::get('/member', [TransactionBooksController::class, 'index'])->name('show.book');
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
Route::get('/admin/peminjam', [AdminController::class, 'peminjam'])->name('admin.peminjam');
Route::get('/admin/kembali', [AdminController::class, 'kembali'])->name('admin.kembali');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/member/cartBook', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/book/{id}/comment', [CommentController::class, 'store'])->name('book.comment');
// routes/web.php
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('book/{book}/show', [BookController::class, 'detail'])->name('book.detail');




Route::post('transactionBook/pinjam', [TransactionsController::class, 'pinjam'])->name('transactionBook.pinjam');
Route::get('/transactionBook/{id}/set-status', [TransactionsController::class, 'setStatus'])->name('transactionBook.status');
Route::get('/transactionBook/lendings', [TransactionsController::class, 'userLendings'])->name('transactionBook.lendings');
Route::post('lendingsBook/{id}/lendings', [LendingsController::class, 'lendings'])->name('lendings');
Route::resource('transactionBook', TransactionsController::class);
Route::resource('book', BookController::class);
Route::resource('genre', GenreController::class);
