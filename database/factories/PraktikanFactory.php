<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Praktikan;
use App\Kelas;
use Faker\Generator as Faker;

$factory->define(Praktikan::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'nim'  => "110217".$faker->numberBetween(1000,9999),
        'password' => bcrypt('cobaaja'),
        'kelas_id' => Kelas::all()->shuffle()->first()->id,
        'alamat' => $faker->address,
        'nomor_telepon' => $faker->tollFreePhoneNumber,
        'email' => $faker->safeEmail 
    ];
});
