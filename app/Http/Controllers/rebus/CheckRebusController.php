<?php

declare(strict_types=1);

namespace App\Http\Controllers\rebus;

use App\Actions\Rebus\CheckRebusWordAction;
use App\DataTransferObjects\InputWordDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckRebusController extends Controller
{
    private CheckRebusWordAction $checkrebusaction;

    public function __construct(CheckRebusWordAction $checkrebusaction)
    {
        $this->checkrebusaction = $checkrebusaction;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $inputWordDto = new InputWordDto(
            word: $request->input('word'),
        );

        $rebusIsCorrect = $this->checkrebusaction->execute($inputWordDto);

        return response()->json([
            'result' => $rebusIsCorrect
        ]);

    }
}
