<?php

declare(strict_types=1);

namespace App\Actions\Rebus;

use App\DataTransferObjects\InputWordDto;

final class CheckRebusWordAction
{
    public function execute(InputWordDto $inputWordDto): bool
    {
        if(strtolower($inputWordDto->word) === 'happy') {
            return true;
        }

        if(strtolower($inputWordDto->word) !== 'happy') {
            return false;
        }
    }
}