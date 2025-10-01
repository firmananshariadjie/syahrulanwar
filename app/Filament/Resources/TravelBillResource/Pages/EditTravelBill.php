<?php

namespace App\Filament\Resources\TravelBillResource\Pages;

use App\Filament\Resources\TravelBillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravelBill extends EditRecord
{
    protected static string $resource = TravelBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
