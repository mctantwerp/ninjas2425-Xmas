<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\EntryKeyDto;

final class CheckEntryKeyAction
{
    public function execute( EntryKeyDto $entryKeyDto): bool
    {
        $gamePage = strtolower($entryKeyDto->game);
        switch ($gamePage) {
            case 'hangman':
                if ($entryKeyDto->key === '18M12') {
                    return true;
                }
                break;
            case 'rebus':
                if ($entryKeyDto->key === 'B5TKC') {
                    return true;
                }
                break;
            case 'search':
                if ($entryKeyDto->key === 'BTF41') {
                    return true;
                }
                break;
            case 'tree':
                if ($entryKeyDto->key === 'WOZG3') {
                    return true;
                }
                break;
            default:
                return false;
                break;
        }
    }
}