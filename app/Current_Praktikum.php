<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_Praktikum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asisten_id', 'kelas_id', 'status',
    ];
}
