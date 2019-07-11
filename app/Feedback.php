<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asisten_id', 'nama_praktikan', 'pesan', 'kelas', 'read',
    ];
}
