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
                Tables\Filters\Filter::make('Exclude Admins')
                    ->query(fn (Builder $query) => $query->where('is_admin', false))
                    ->label('Exclude Admins'),
                Tables\Filters\Filter::make('Winners')
                    ->query(fn (Builder $query) => $query->where('has_won', true))
                    ->label('Winners'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ])
            ->headerActions([
                Tables\Actions\Action::make('Pick Winners')
                    ->action(function () {
                        // Use a database transaction to ensure data integrity
                        DB::transaction(function () {
                            // Select 4 random users who haven't won yet
                            $usersToUpdate = User::where('has_won', 0)
                                ->where('is_admin', false)
                                ->inRandomOrder() // Randomize the selection
                                ->limit(3)
                                ->get();

                            // Update their 'has_won' status
                            foreach ($usersToUpdate as $user) {
                                $user->update(['has_won' => 1]);
                            }

                            // Provide feedback to the user via notification
                            Notification::make()
                                ->title('Winners Picked')
                                ->body(count($usersToUpdate) . ' users have been randomly selected as winners.')
                                ->success()
                                ->send();
                        });
                    })
                    ->requiresConfirmation() // Optional: Asks for confirmation before running
                    ->label('Pick Winners')
                    ->color('primary'), // Optional: Styling for the action button
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
