<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modul_id', 'kelas_id', 'pj_id', 'laporan_id',
    ];
}
