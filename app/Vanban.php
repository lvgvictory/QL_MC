<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vanban extends Model
{
	protected $table = 'vanbans';

    public function minhchung()
    {
        return $this->belongsTo(Minhchung::class);
    }
}
