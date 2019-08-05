<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_Soaljurnal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'allJurnal_id', 'allFitb_id',
    ];
}
