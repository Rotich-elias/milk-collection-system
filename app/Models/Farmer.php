<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = ['name', 'phone', 'village'];

    public function milkCollections()
    {
        return $this->hasMany(MilkCollection::class);
    }

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }
}
