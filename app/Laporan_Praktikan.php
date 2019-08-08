<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan_Praktikan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pesan', 'asisten_id', 'modul_id', 'praktikan_id', 'rating_praktikum', 'rating_asisten',
    ];
}
