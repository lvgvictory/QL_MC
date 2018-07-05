<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tieuchuan extends Model
{
    protected $table = 'tieuchuans';
    protected $fillable = [
        'ten_tieu_chuan',
        'mo_dau',
        'ket_luan'
    ];

    public function tieuchis()
    {
        return $this->hasMany(Tieuchi::class);
    }
}
