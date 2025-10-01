<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelGroup extends Model
{
    protected $table = 'travel_groups';
    use HasFactory;
    protected $fillable = ['travel_id', 'name', 'quota', 'start_date', 'end_date'];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function bill()
    {
        return $this->hasOne(TravelBill::class, 'travelgroup_id','id');
    }


}

