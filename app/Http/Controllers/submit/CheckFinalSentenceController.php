<?php

declare(strict_types=1);

namespace App\Http\Controllers\submit;

use Illuminate\Http\Request;
use App\DataTransferObjects\FinalSentenceDto;
use App\Actions\CheckFinalSentenceAction;
use App\Http\Controllers\Controller;

class CheckFinalSentenceController extends Controller
{
    private CheckFinalSentenceAction $checkFinalSentenceAction;

    public function __construct(CheckFinalSentenceAction $checkFinalSentenceAction)
    {
        $this->checkFinalSentenceAction = $checkFinalSentenceAction;
    }
    public function __invoke(Request $request)
    {
        $finalSentenceDto = new FinalSentenceDto(
            sentence: $request->input('finalSentence'),
        );

        $sentenceIsCorrect = $this->checkFinalSentenceAction->execute($finalSentenceDto);

        return response()->json([
            'result' => $sentenceIsCorrect
        ]);

    }
}
