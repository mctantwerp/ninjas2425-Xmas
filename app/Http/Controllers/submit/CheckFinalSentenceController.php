<?php

declare(strict_types=1);

namespace App\Http\Controllers\submit;

use App\Actions\CheckFinalSentenceAction;
use App\DataTransferObjects\FinalSentenceDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
