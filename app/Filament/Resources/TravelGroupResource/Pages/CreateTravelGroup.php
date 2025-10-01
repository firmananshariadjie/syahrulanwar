<?php

namespace App\Filament\Resources\TravelGroupResource\Pages;

use App\Filament\Resources\TravelGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTravelGroup extends CreateRecord
{
    protected static string $resource = TravelGroupResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('travel_id')) {
            $data['travel_id'] = request()->get('travel_id');
        }

        return $data;
    }
}

