<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelGroupResource\Pages;
use App\Filament\Resources\TravelGroupResource\RelationManagers;
use App\Models\TravelGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;

class TravelGroupResource extends Resource
{
    protected static ?string $model = TravelGroup::class;


    protected static ?string $navigationIcon = 'heroicon-o-users';

    // Masuk ke dalam Travel Management
    protected static ?string $navigationGroup = 'Travel Management';

    // Biar diurutkan setelah Travels
    protected static ?int $navigationSort = 2;

    // Kalau mau langsung nested di bawah Travel
    protected static ?string $navigationParentItem = 'Travels';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('travel_id')
                    ->default(fn () => request()->get('travel_id'))
                    ->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('quota')->required()->label('Pax'),
                Forms\Components\DatePicker::make('start_date')
                    ->native(false),
                Forms\Components\DatePicker::make('end_date')
                    ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('travel.travel_name')
                ->label('Travel Name')
                ->sortable()       // opsional, bisa diurutkan
                ->searchable(), 
                TextColumn::make('name'),
                TextColumn::make('quota')
                ->label('Pax'),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                IconColumn::make('travelBill')
                ->label('Travel Bill')
                ->boolean() // otomatis true/false
                ->getStateUsing(fn ($record) => $record->bill !== null) // cek relasi
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->disabled(fn ($record) => $record->travel->status === 'Close'), // disable jika travel close
                Action::make('addBill')
                ->disabled(fn ($record) => $record->bill !== null)
                ->label('Add Bill')
                ->url(fn ($record) => TravelBillResource::getUrl('create', [
                    'travelgroup_id' => $record->id,
                ]))
                ->icon('heroicon-o-plus')
                ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BillsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTravelGroups::route('/'),
            'create' => Pages\CreateTravelGroup::route('/create'),
            'edit' => Pages\EditTravelGroup::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (request()->has('travel_id')) {
            $query->where('travel_id', request()->get('travel_id'));
        }

        return $query;
    }
}
