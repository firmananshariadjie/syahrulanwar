<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
