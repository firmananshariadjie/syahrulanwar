<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TravelGroup;

class TravelBill extends Model
{
    protected $table = 'travel_bills';
    use HasFactory;
    protected $fillable = ['travelgroup_id', 'fee_in_out', 'fee_snack', 'trip', 'quota_add', 'total'];

    public function travelgroup()
    {
        return $this->belongsTo(TravelGroup::class);
    }

    // Hitung total dinamis jika tidak ingin hardcode ke kolom "total"
    public function getCalculatedTotalAttribute(): int
    {
        return ($this->fee_in_out ?? 0)
            + ($this->quota_add ?? 0)
            + ($this->fee_snack ?? 0)
            + ($this->trip ?? 0);
    }
}
