<?php

namespace App\DataTransferObjects;

class HangmanLetterDto
{
    public function __construct(
        public string $letter,
    ){
    }
}