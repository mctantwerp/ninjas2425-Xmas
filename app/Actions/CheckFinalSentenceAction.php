<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\FinalSentenceDto;

final class CheckFinalSentenceAction
{
    public function execute( FinalSentenceDto $finalSentenceDto): bool
    {
        $submittedSentence = preg_replace('/\s+/', '', strtolower($finalSentenceDto->sentence));

        if($submittedSentence === 'happychristmasfrommct'){
            return true;
        }else{
            return false;
        }
    }
}