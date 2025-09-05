<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilkCollection extends Model
{
    protected $fillable = ['farmer_id', 'date', 'quantity'];

    protected $casts = [
        'date' => 'date',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
