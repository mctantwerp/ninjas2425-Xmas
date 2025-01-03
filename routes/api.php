<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rebus\CheckRebusController;
use App\Http\Controllers\CheckEntryKeyController;
use App\Http\Controllers\submit\CheckFinalSentenceController;
use App\Http\Controllers\hangman\CheckHangmanLetterController;
use App\Http\Controllers\tree\CheckTreeController;
use App\Http\Controllers\PutEmailInDatabaseController;

Route::post('/checkRebus', CheckRebusController::class)->name('checkRebus');
Route::post('/checkEntry', CheckEntryKeyController::class)->name('checkEntry');
Route::post('/checkFinalSentence', CheckFinalSentenceController::class)->name('checkFinalSentence');
Route::post('/checkHangmanLetter', CheckHangmanLetterController::class)->name('checkHangmanLetter');
Route::post('/checkTree', CheckTreeController::class)->name('checkTree');
Route::post('/save-email', PutEmailInDatabaseController::class)->name('saveEmail');