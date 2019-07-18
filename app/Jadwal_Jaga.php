<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Jaga extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_id', 'asisten_id',
    ];
}
