<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Modul;
use Faker\Generator as Faker;

$factory->define(Modul::class, function (Faker $faker) {
    return [
        'isi' => $faker->text,
        'deskripsi' => $faker->text,
        'judul' => $faker->sentence,
    ];
});
