<?php

declare(strict_types=1);

namespace App\Http\Controllers\hangman;

use App\Actions\Hangman\CheckHangmanLetterAction;
use App\DataTransferObjects\HangmanLetterDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckHangmanLetterController extends Controller
{
    public function __invoke(Request $request, CheckHangmanLetterAction $checkHangmanLetterAction) : JsonResponse
    {
        $hangmanLetterDto = new HangmanLetterDto(
            letter: $request->input('letter')
        );
        //dd($hangmanLetterDto);
        $hangmanLetterIsCorrect =$checkHangmanLetterAction->execute($hangmanLetterDto);

        return response()->json([
            'result' => $hangmanLetterIsCorrect
        ]);
    }
}
