<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_Jawabantp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'soal_id', 'jawaban',
    ];
}
