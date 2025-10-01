<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelBillResource\Pages;
use App\Filament\Resources\TravelBillResource\RelationManagers;
use App\Models\TravelBill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\TravelGroup;

class TravelBillResource extends Resource
{
    protected static ?string $model = TravelBill::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?string $navigationGroup = 'Travel Management';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationParentItem = 'Travels';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Hidden::make('travelgroup_id')
                ->default(fn () => request()->get('travelgroup_id'))
                ->required(),                
            Forms\Components\TextInput::make('fee_in_out')->numeric()->label('Fee Check IN/OUT')->required()->reactive()->prefix('SAR'),
            Forms\Components\TextInput::make('quota_add')->numeric()->label('Add PAX')->required()->reactive(),
            Forms\Components\TextInput::make('fee_snack')->numeric()->label('Fee Snack')->required()->reactive()->prefix('SAR'),
            Forms\Components\TextInput::make('trip')->numeric()->label('Trip')->required()->reactive()
             ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    self::recalculateTotal($set, $get);
                }),
            Forms\Components\TextInput::make('total')
                ->numeric()
                ->label('Total')
                ->prefix('SAR')
                ->required(),
                // ->disabled(), // supaya user tidak bisa edit manual
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('travelgroup_id'),
                Tables\Columns\TextColumn::make('fee_in_out'),
                Tables\Columns\TextColumn::make('fee_snack'),
                Tables\Columns\TextColumn::make('trip'),
                Tables\Columns\TextColumn::make('total')
                                ->money('sar'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTravelBills::route('/'),
            'create' => Pages\CreateTravelBill::route('/create'),
            'edit' => Pages\EditTravelBill::route('/{record}/edit'),
        ];
    }

    protected static function recalculateTotal(callable $set, callable $get): void
    {
        $travel = TravelGroup::find($get('travelgroup_id'));
        $quotaTravel = $travel?->quota ?? 0;

        $set('total',
            (int) ($get('fee_in_out') ?? 0)
            + 
            ((((int) ($get('quota_add') ?? 0) + (int) $quotaTravel) * (int) ($get('fee_snack') ?? 0)) * (int) ($get('trip') ?? 0))
            
        );
    }
}
