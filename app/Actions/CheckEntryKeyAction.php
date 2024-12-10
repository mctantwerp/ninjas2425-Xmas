<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\EntryKeyDto;

final class CheckEntryKeyAction
{
    public function execute( EntryKeyDto $entryKeyDto): bool
    {
        $validKeys = [
            'hangman' => '18M12',
            'rebus'   => 'B5TKC',
            'search'  => 'BTF41',
            'tree'    => 'WOZG3',
        ];

        $gamePage = strtolower($entryKeyDto->game);
        $entryKey = strtoupper($entryKeyDto->key);

        // Check if the game exists in the valid keys array and validate the entry key
        return isset($validKeys[$gamePage]) && $validKeys[$gamePage] === $entryKey;
    }
}
