<?php

declare(strict_types=1);

namespace App\Actions\Tree;

use App\DataTransferObjects\InputWordDto;

final class CheckTreeWordAction
{
    public function execute(InputWordDto $inputWordDto): bool
    {
        if(strtolower($inputWordDto->word) === 'from') {
            return true;
        }

        if(strtolower($inputWordDto->word) !== 'from') {
            return false;
        }
    }
}