<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CheckEntryKeyAction;
use App\DataTransferObjects\EntryKeyDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckEntryKeyController extends Controller
{
    private CheckEntryKeyAction $checkEntryKeyAction;

    public function __construct(CheckEntryKeyAction $checkentrykeyaction)
    {
        $this->checkEntryKeyAction = $checkentrykeyaction;
    }
    public function __invoke(Request $request) : JsonResponse
    {
        $entrykeydto = new EntryKeyDto(
            game: $request->input('game'),
            key: $request->input('enterd_key'),
        );

        $response = $this->checkEntryKeyAction->execute($entrykeydto);
        return response()->json([
            'passwordCorrect' => $response
        ]);

    }
}
