<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\tree\ShowTreeController;
use App\Http\Controllers\rebus\ShowRebusController;
use App\Http\Controllers\search\ShowSearchController;
use App\Http\Controllers\hangman\ShowHangmanController;



Route::get('/', DefaultController::class)->name('home');
Route::get('/tree', ShowTreeController::class)->name('tree');
Route::get('/rebus', ShowRebusController::class)->name('rebus');
Route::get('/search', ShowSearchController::class)->name('search');
Route::get('/hangman', ShowHangmanController::class)->name('hangman');
