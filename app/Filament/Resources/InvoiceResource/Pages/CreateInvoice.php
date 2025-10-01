<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Travel;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $travels = Travel::with(['groups.bill'])
    //         ->whereIn('id', $data['travel_ids'] ?? [])
    //         ->get();
    //     dd($travels);
    //     $total = 0;
    //     dd($total);
    //     foreach ($travels as $travel) {
    //         $subtotal = $travel->groups->sum(fn ($g) => $g->bill?->total ?? 0);
    //         $total += $subtotal;
    //     }

    //     $data['total_amount'] = $total;

    //     return $data;
    // }

    protected function afterCreate(): void
    {
        $travels = Travel::with('groups.bill')
            ->whereIn('id', $this->record->travels->pluck('id'))
            ->get();

        $pivotData = [];

        foreach ($travels as $travel) {
            $subtotal = $travel->groups->sum(fn ($g) => $g->bill?->total ?? 0);
            $pivotData[$travel->id] = ['subtotal' => $subtotal];
        }

        $this->record->travels()->sync($pivotData);
    }


}
