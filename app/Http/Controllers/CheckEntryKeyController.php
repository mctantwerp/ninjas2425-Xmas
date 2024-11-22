<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataTransferObjects\EntryKeyDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\CheckEntryKeyAction;
class CheckEntryKeyController extends Controller
{
    private CheckEntryKeyAction $checkEntryKeyAction;

    public function __construct(CheckEntryKeyAction $checkentrykeyaction)
    {
        $this->checkEntryKeyAction = $checkentrykeyaction;
    }
    public function __invoke(Request $request) : JsonResponse
    {
        $game = request()->segment(count(request()->segments()));

        $entrykeydto = new EntryKeyDto(
            key: $request->input('enterd_key'),
        );

        $response = $this->checkEntryKeyAction->execute($game, $entrykeydto);
        return response()->json([
            'passwordCorrect' => $response
        ]);
        
    }
}
