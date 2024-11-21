<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rebus\CheckRebusController;

Route::post('/checkRebus', CheckRebusController::class)->name('checkRebus');
