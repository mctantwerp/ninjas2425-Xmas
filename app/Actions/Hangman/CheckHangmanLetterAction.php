<?php

declare(strict_types=1);

namespace App\Actions\Hangman;

use App\DataTransferObjects\HangmanLetterDto;

final class CheckHangmanLetterAction
{
    public function execute( HangmanLetterDto $hangmanLetterDto): array
    {
        $word = "christmas";
        $letter = strtolower($hangmanLetterDto->letter);

        $indexes = [];
        for ($i = 0; $i < strlen($word); $i++) {
            if ($word[$i] === $letter) {
                $indexes[] = $i;
            }
        }

        return $indexes;
    }
}