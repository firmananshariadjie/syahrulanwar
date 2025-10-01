<?php

namespace App\Filament\Resources\TravelGroupResource\Pages;

use App\Filament\Resources\TravelGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTravelGroups extends ListRecords
{
    protected static string $resource = TravelGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
