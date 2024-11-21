<?php

declare(strict_types=1);

namespace App\Actions\Rebus;

use App\DataTransferObjects\RebusWordDto;

final class CheckRebusWordAction
{
    public function execute(RebusWordDto $rebusWordDto): bool
    {
        if(strtolower($rebusWordDto->word) === 'happy') {
            return true;
        }

        if(strtolower($rebusWordDto->word) !== 'happy') {
            return false;
        }
    }
}