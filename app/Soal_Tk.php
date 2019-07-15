<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal_Tk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pertanyaan', 'modul_id', 'jawaban_benar', 'jawaban_salah1', 'jawaban_salah2', 'jawaban_salah3',
    ];
}
