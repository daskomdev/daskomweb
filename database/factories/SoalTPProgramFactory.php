<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Modul;
use App\Soal_Tp;
use Faker\Generator as Faker;

$factory->define(Soal_Tp::class, function (Faker $faker) {
    return [
        'modul_id' => Modul::all()->shuffle()->first()->id,
        'soal' => $faker->realText,
        'isEssay' => 0,
        'isProgram' => 1,
    ];
});
