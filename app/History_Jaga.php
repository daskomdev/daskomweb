<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History_Jaga extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hari', 'shift', 'pj', 'asisten_id', 'modul_id'
    ];
}
