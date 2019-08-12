<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kumpul_Tp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modul_id', 'praktikan_id', 'kelas_id',  
    ];
}
