<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban_Tp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'praktikan_id', 'soal_id', 'modul_id', 'jawaban',
    ];
}
