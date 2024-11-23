<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rebus\CheckRebusController;
use App\Http\Controllers\CheckEntryKeyController;
use App\Http\Controllers\submit\CheckFinalSentenceController;

Route::post('/checkRebus', CheckRebusController::class)->name('checkRebus');
Route::post('/checkEntry', CheckEntryKeyController::class)->name('checkEntry');
Route::post('/checkFinalSentence', CheckFinalSentenceController::class)->name('checkFinalSentence');
