<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'praktikum_id', 'jurnal_id', 'fitb_id',
    ];
}
