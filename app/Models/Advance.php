<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    protected $fillable = ['farmer_id', 'date', 'amount'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
