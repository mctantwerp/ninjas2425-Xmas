<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\EntryKeyDto;

final class CheckEntryKeyAction
{
    public function execute( EntryKeyDto $entryKeyDto): bool
    {
        $gamePage = strtolower($entryKeyDto->game);
        $entryKey = strtoupper($entryKeyDto->key);
        switch ($gamePage) {
            case 'hangman':
                if ($entryKey === '18M12') {
                    return true;
                }
                if ($entryKey !== '18M12') {
                    return false;
                }
                break;
            case 'rebus':
                if ($entryKey === 'B5TKC') {
                    return true;
                }
                if ($entryKey !== 'B5TKC') {
                    return false;
                }
                break;
            case 'search':
                if ($entryKey === 'BTF41') {
                    return true;
                }
                if ($entryKey !== 'BTF41') {
                    return false;
                }
                break;
            case 'tree':
                if ($entryKey === 'WOZG3') {
                    return true;
                }
                if ($entryKey !== 'WOZG3') {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
    }
}