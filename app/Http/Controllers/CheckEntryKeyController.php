<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CheckEntryKeyAction;
use App\DataTransferObjects\EntryKeyDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckEntryKeyController extends Controller
{
    public function __invoke(Request $request, CheckEntryKeyAction $checkEntryKeyAction) : JsonResponse
    {
        $entrykeydto = new EntryKeyDto(
            game: $request->input('game'),
            key: $request->input('enterd_key'),
        );

        $response = $checkEntryKeyAction->execute($entrykeydto);
        return response()->json([
            'passwordCorrect' => $response
        ]);

    }
}
