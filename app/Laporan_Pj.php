<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan_Pj extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'allasisten_id', 'laporan', 'hari', 'shift', 'modul_id',
    ];
}
