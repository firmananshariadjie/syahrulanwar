<?php

namespace App\Filament\Resources\TravelGroupResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\TravelGroup;

class BillsRelationManager extends RelationManager
{
    protected static string $relationship = 'bill';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fee_in_out')->numeric()->label('Fee Check IN/OUT')->required()->prefix('SAR'),
                Forms\Components\TextInput::make('quota_add')->numeric()->label('Add PAX')->required(),
                Forms\Components\TextInput::make('fee_snack')->numeric()->label('Fee Snack')->required()->prefix('SAR'),
                Forms\Components\TextInput::make('trip')
                    ->numeric()
                    ->label('Trip')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set, $get) => 
                        self::recalculateTotal($set, $get, $this->getOwnerRecord())
                    ),
                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->label('Total')
                    ->prefix('SAR')
                    ->required(),
                ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('travelgroup_id')
            ->columns([
                Tables\Columns\TextColumn::make('fee_in_out')->money('SAR'),
                Tables\Columns\TextColumn::make('fee_snack')->money('SAR'),
                Tables\Columns\TextColumn::make('trip'),
                Tables\Columns\TextColumn::make('total')->money('SAR'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->disabled(fn () => $this->getOwnerRecord()->bill !== null),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function recalculateTotal(callable $set, callable $get, $travelGroup): void
    {
        $quotaTravel = $travelGroup?->quota ?? 0;

        $set('total',
            (int) ($get('fee_in_out') ?? 0)
            +
            (
                (
                    ((int) ($get('quota_add') ?? 0) + (int) $quotaTravel) 
                    * (int) ($get('trip') ?? 0)
                )
                * (int) ($get('fee_snack') ?? 0)
            )
        );
    }
}
