<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travel';
    use HasFactory;
    protected $fillable = ['travel_name', 'description', 'status', 'status_payment'];

    public function groups()
    {
        return $this->hasMany(TravelGroup::class);
    }

    public function bills()
    {
        return $this->hasManyThrough(
            TravelBill::class,
            TravelGroup::class,
            'travel_id',       // FK di travel_groups
            'travelgroup_id',  // FK di travel_bills
            'id',              // PK di travels
            'id'               // PK di travel_groups
        );
    }
    // public function getBillsTotalAttribute()
    // {
    //     return $this->groups()
    //         ->with('bill')
    //         ->get()
    //         ->sum(fn ($group) => $group->bill?->total ?? 0);
    // }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_travel')
                    ->withPivot('subtotal')
                    ->withTimestamps();
    }

}
