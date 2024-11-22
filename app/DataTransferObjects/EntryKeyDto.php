<?php

namespace App\DataTransferObjects;

class EntryKeyDto
{
    public function __construct(
        public string $game,
        public string $key,
    ){
    }   
}
