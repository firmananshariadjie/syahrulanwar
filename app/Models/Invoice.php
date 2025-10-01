<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'invoice_number',
        'total_amount',
        'status',
        'kurs'
    ];

    public function travels()
    {
        return $this->belongsToMany(Travel::class, 'invoice_travel')
                    ->withPivot('subtotal')
                    ->withTimestamps();
    }

    public static function generateInvoiceNumber(): string
    {
        $last = self::latest('id')->first();
        $next = $last ? $last->id + 1 : 1;

        return 'INV-' . date('Y') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    protected static function booted()
    {
         static::saved(function ($invoice) {
            Log::info('Invoice saved with travels', [
                'invoice_id' => $invoice->id,
                'status' => $invoice->status,
                'travels' => $invoice->travels->pluck('id'),
            ]);

            if ($invoice->status === 'paid') {
                foreach ($invoice->travels as $travel) {
                    $travel->update(['status_payment' => 'Lunas']);
                    Log::info('Travel updated to Lunas', [
                        'travel_id' => $travel->id,
                    ]);
                }
            }
        });
    }

}
