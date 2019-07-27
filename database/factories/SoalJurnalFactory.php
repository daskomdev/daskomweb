<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Modul;
use App\Soal_Jurnal;
use Faker\Generator as Faker;

$factory->define(Soal_Jurnal::class, function (Faker $faker) {
    return [
        'modul_id' => Modul::all()->shuffle()->first()->id,
        'soal' => $faker->realText,
    ];
});
