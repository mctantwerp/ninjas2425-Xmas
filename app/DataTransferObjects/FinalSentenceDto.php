<?php

namespace App\DataTransferObjects;

class FinalSentenceDto
{
    public function __construct(
        public string $sentence,
    ){
    }
}