<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History_Izin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hari', 'shift', 'status', 'asisten_id', 'modul_id'
    ];
}
