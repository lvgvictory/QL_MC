<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minhchung extends Model
{
    protected $table = 'minhchungs';

    public function vanbans()
    {
        return $this->hasMany(Vanban::class);
    }

    public function tieuchi()
    {
        return $this->belongsTo(Tieuchi::class);
    }
}
