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
        factory(App\Praktikan::class, 30)->create();
        factory(App\Asisten::class, 15)->create();
    }
}
