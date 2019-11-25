<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polling extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'polling_id', 'asisten_id', 'praktikan_id',
    ];
}
