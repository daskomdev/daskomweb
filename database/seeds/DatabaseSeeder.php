<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kelas::class, 1)->create();
        factory(App\Modul::class, 2)->create();
        factory(App\Praktikan::class, 30)->create();
        factory(App\Asisten::class, 15)->create();
        factory(App\Soal_Fitb::class, 25)->create();
        factory(App\Soal_Jurnal::class, 25)->create();
        factory(App\Soal_Mandiri::class, 25)->create();
        factory(App\Soal_Ta::class, 25)->create();
        factory(App\Soal_Tk::class, 25)->create();
        factory(App\Soal_Tp::class, 25)->create([
            'isEssay' => 1,
        ]);
        factory(App\Soal_Tp::class, 25)->create([
            'isProgram' => 1,
        ]);
    }
}
