<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;



class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Admins')
                    ->query(fn (Builder $query) => $query->where('is_admin', true))
                    ->label('Admins'),
                Tables\Filters\Filter::make('Winners')
                    ->query(fn (Builder $query) => $query->where('has_won', true))
                    ->label('Winners'),
            ])
            ->actions([
            ])
            ->headerActions([
                Tables\Actions\Action::make('Pick Winners')
                    ->icon('heroicon-o-trophy')
                    ->action(function () {
                        DB::transaction(function () {
                            if(count(User::where('has_won', 1)->get()) > 0){
                                Notification::make()
                                    ->title('Winners already selected')
                                    ->body('There were already winners selected.')
                                    ->danger()
                                    ->send();
                            }
                            else {
                                $usersToUpdate = User::where('has_won', 0)
                                    ->where('is_admin', false)
                                    ->inRandomOrder()
                                    ->limit(3)
                                    ->get();

                                foreach ($usersToUpdate as $user) {
                                    $user->update(['has_won' => 1]);
                                }

                                Notification::make()
                                    ->title('Winners Picked')
                                    ->body(count($usersToUpdate) . ' users have been randomly selected as winners.')
                                    ->success()
                                    ->send();
                            }
                        });
                    })
                    ->requiresConfirmation()
                    ->label('Pick Winners')
                    ->color('primary'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
