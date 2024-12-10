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
    private CheckHangmanLetterAction $checkhangmanletteraction;

    public function __construct(CheckHangmanLetterAction $checkHangmanLetterAction)
    {
        $this->checkhangmanletteraction = $checkHangmanLetterAction;
    }
    public function __invoke(Request $request) : JsonResponse
    {
        $hangmanLetterDto = new HangmanLetterDto(
            letter: $request->input('letter')
        );
        //dd($hangmanLetterDto);
        $hangmanLetterIsCorrect = $this->checkhangmanletteraction->execute($hangmanLetterDto);

        return response()->json([
            'result' => $hangmanLetterIsCorrect
        ]);
    }
}
