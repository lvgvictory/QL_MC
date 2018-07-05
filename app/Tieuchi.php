<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tieuchi extends Model
{
    protected $table = 'tieuchis';

    public function minhchungs()
    {
        return $this->hasMany(Minhchung::class);
    }

    public function tieuchuan()
    {
        return $this->belongsTo(Tieuchuan::class);
    }
}
