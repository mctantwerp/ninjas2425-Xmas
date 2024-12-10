<?php

namespace App\DataTransferObjects;

class InputWordDto
{
    public function __construct(
        public string $word,
    ){
    }
}
