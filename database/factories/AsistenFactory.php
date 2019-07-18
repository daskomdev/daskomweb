<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Asisten;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Asisten::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'kode'  => strtoupper($faker->randomLetter.$faker->randomLetter.$faker->randomLetter),
        'password' => bcrypt('cobaaja'),
        'role_id' => Role::all()->shuffle()->first()->id,
        'deskripsi' => $faker->text,
    ];
});
