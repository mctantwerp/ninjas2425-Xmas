<?php

declare(strict_types=1);

namespace App\Http\Controllers\tree;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTransferObjects\InputWordDto;
use App\Actions\Tree\CheckTreeWordAction;
use Illuminate\Http\JsonResponse;

class CheckTreeController extends Controller
{
    private CheckTreeWordAction $checktreeaction;

    public function __construct(CheckTreeWordAction $checktreeaction)
    {
        $this->checktreeaction = $checktreeaction;
    }
    public function __invoke(Request $request) : JsonResponse
    {
        $inputWordDto = new InputWordDto(
            word: $request->input('word'),
        );

        $data = $this->checktreeaction->execute($inputWordDto);

        return response()->json([
            'result' => $data
        ]);
    }
}
