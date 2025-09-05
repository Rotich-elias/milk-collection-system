<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilkCollection extends Model
{
    protected $fillable = ['farmer_id', 'date', 'quantity'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
