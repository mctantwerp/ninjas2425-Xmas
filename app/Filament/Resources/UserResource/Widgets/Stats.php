<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Participants', User::all()->where('is_admin', 0)->count()),
        ];
    }
}
