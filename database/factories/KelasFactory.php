<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Kelas;
use Faker\Generator as Faker;

$factory->define(Kelas::class, function (Faker $faker) {
    return [
        'hari' => 'senin',
        'shift' => 4,
        'kelas' => 'EL-41-05'
    ];
});
