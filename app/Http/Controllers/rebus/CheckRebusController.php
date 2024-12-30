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
    public function __invoke(Request $request, CheckRebusWordAction $checkRebusWordAction): JsonResponse
    {
        $inputWordDto = new InputWordDto(
            word: $request->input('word'),
        );

        $rebusIsCorrect = $checkRebusWordAction->execute($inputWordDto);

        return response()->json([
            'result' => $rebusIsCorrect
        ]);

    }
}
