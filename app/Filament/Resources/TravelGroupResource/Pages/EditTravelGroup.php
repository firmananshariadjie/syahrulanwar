<?php

namespace App\Filament\Resources\TravelGroupResource\Pages;

use App\Filament\Resources\TravelGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravelGroup extends EditRecord
{
    protected static string $resource = TravelGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PostsRelationManager::class,
        ];
    }
}
