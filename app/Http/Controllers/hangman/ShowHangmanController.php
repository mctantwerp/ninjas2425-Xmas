<?php

declare(strict_types=1);

namespace App\Http\Controllers\hangman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;



class ShowHangmanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : View
    {
        return View('hangman');
    }
}
