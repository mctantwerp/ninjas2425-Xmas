<?php

declare(strict_types=1);

namespace App\Http\Controllers\tree;


use App\Actions\Tree\CheckTreeWordAction;
use App\DataTransferObjects\InputWordDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckTreeController extends Controller
{
    public function __invoke(Request $request, CheckTreeWordAction $checkTreeAction) : JsonResponse
    {
        $inputWordDto = new InputWordDto(
            word: $request->input('word'),
        );

        $treeIsCorrect = $checkTreeAction->execute($inputWordDto);
        $cookie = cookie('tree', $treeIsCorrect, 20160);

        return response()->json([
            'result' => $treeIsCorrect
        ])->withCookie($cookie);
    }
}
