<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelResource\Pages;
use App\Filament\Resources\TravelResource\RelationManagers;
use App\Models\Travel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;


class TravelResource extends Resource
{
    protected static ?string $model = Travel::class;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Travels';
    protected static ?string $navigationGroup = 'Travel Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('travel_name')->required(),
                 Forms\Components\TextInput::make('description'),
                 Forms\Components\Select::make('status')
                    ->options([
                        'Open' => 'Open',
                        'Close' => 'Close',                        
                    ])
                    ->native(false),
                Forms\Components\Select::make('status_payment')
                    ->options([
                        'Lunas' => 'Lunas',
                        'Belum Lunas' => 'Belum Lunas',                        
                    ])
                    ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('travel_name')
                ->sortable()
                ->searchable(),
                TextColumn::make('description'),
                TextColumn::make('status')
                ->sortable()
                ->searchable(),
                Tables\Columns\BadgeColumn::make('status_payment')
                ->colors([
                    'danger' => 'Belum Lunas',
                    'success' => 'Lunas',
                ])
                ->sortable()
                ->searchable(),
                TextColumn::make('group_count')
                    ->label('Total Groups')
                    ->getStateUsing(fn ($record) => $record->groups()->count()),
                TextColumn::make('bills_sum_total')
                    ->label('Total Bills')
                    ->money('sar')                  
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn ($record) => $record->status !== 'Open'), // hide kalau Open
                Action::make('addGroup')
                    ->label('Add Group')
                    ->url(fn ($record) => TravelGroupResource::getUrl('create', [
                        'travel_id' => $record->id,
                    ]))
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->disabled(fn ($record) => $record->status !== 'Open'), // hide kalau Close
                Action::make('viewGroups')
                    ->label('View Groups')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => TravelGroupResource::getUrl('index', [
                        'travel_id' => $record->id,
                    ])),
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
            RelationManagers\GroupsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTravel::route('/'),
            'create' => Pages\CreateTravel::route('/create'),
            'edit' => Pages\EditTravel::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withCount('groups')
            ->withSum('bills', 'total');
    }
}
