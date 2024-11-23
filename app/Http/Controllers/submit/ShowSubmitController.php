<?php

declare(strict_types=1);

namespace App\Http\Controllers\submit;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ShowSubmitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : View
    {
        return View('submit');
    }
}
