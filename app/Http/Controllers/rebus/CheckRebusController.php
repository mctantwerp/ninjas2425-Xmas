<?php

declare(strict_types=1);

namespace App\Http\Controllers\rebus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Rebus\CheckRebusWordAction;
use App\DataTransferObjects\RebusWordDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CheckRebusController extends Controller
{
    private CheckRebusWordAction $checkrebusaction;

    public function __construct(CheckRebusWordAction $checkrebusaction)
    {
        $this->checkrebusaction = $checkrebusaction;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $rebusWordDto = new RebusWordDto(
            word: $request->input('word'),
        );

        $data = $this->checkrebusaction->execute($rebusWordDto);

        return response()->json([
            'result' => $data
        ]);

    }
}
