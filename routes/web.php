<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;

Route::get('/', DefaultController::class)->name('home');
Route::get('/tree', DefaultController::class)->name('tree');
Route::get('/rebus', DefaultController::class)->name('rebus');
Route::get('/search', DefaultController::class)->name('search');
Route::get('/hangman', DefaultController::class)->name('hangman');
