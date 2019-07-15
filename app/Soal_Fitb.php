<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal_Fitb extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'soal', 'modul_id',
    ];
}
