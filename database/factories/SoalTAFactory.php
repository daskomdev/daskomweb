<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Modul;
use App\Soal_Ta;
use Faker\Generator as Faker;

$factory->define(Soal_Ta::class, function (Faker $faker) {
    return [
        'modul_id' => Modul::all()->shuffle()->first()->id,
        'pertanyaan' => $faker->realText,
        'jawaban_benar' => $faker->text,
        'jawaban_salah1' => $faker->text,
        'jawaban_salah2' => $faker->text,
        'jawaban_salah3' => $faker->text,
    ];
});
