<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\RMVC\Route\Route;

/** Стартовая страница */
Route::get('/', [IndexController::class, 'index'])->name('posts.index')->middleware('auth');
/** Стартовая страница постов */
Route::get('posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
/** Post запрос на стартовую страницу постов */
Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
/** Страница поста */
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
