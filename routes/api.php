<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rebus\CheckRebusController;
use App\Http\Controllers\CheckEntryKeyController;

Route::post('/checkRebus', CheckRebusController::class)->name('checkRebus');
Route::post('/checkEntry', CheckEntryKeyController::class)->name('checkEntry');
