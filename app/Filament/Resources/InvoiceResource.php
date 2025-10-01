<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        protected static ?string $navigationLabel = 'Invoices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('invoice_number')
                    ->default(fn () => \App\Models\Invoice::generateInvoiceNumber())
                    ->label('Invoice Number'),
                Forms\Components\Select::make('travel_id')
                    ->label('Travels')
                    ->multiple()
                    ->relationship(
                        name: 'travels',
                        titleAttribute: 'travel_name',
                        modifyQueryUsing: fn (\Illuminate\Database\Eloquent\Builder $query) => 
                        $query->where('status', 'close')
                    )
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $total = \App\Models\Travel::with(['groups.bill'])
                            ->whereIn('id', $state ?? [])
                            ->get()
                            ->sum(fn ($travel) => $travel->groups->sum(fn ($g) => $g->bill?->total ?? 0));

                        $set('total_amount', $total);
                    })
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric(),
                Forms\Components\TextInput::make('kurs')
                    ->label('KURS')
                    ->default(0)
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'paid' => 'Paid',
                        'canceled' => 'Canceled',
                    ])
                    ->default('draft'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total_amount')->money('SAR'),
                Tables\Columns\TextColumn::make('kurs')->money('idr'),
                Tables\Columns\TextColumn::make('grand_total')
                        ->label('Grand Total')
                        ->money('idr') // format uang
                        ->getStateUsing(fn ($record) => ($record->kurs ?? 0) * ($record->total_amount ?? 0)),
                Tables\Columns\TextColumn::make('status')->badge(),   
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('exportPdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn ($record) => route('invoices.export', $record->id))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
