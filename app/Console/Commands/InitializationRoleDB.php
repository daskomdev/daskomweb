<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Role;
use App\Configuration;
use Illuminate\Support\Facades\DB;

class InitializationRoleDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialiaze the Daskom Web Apps ROLE Model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $password = $this->secret('Who are you ?');
        if($password === "devkom"){
            $this->question("This will delete all the Database current data");
            if ($this->confirm('Do you wish to continue?')) {
                $this->line("Processing Initialization");
                $bar = $this->output->createProgressBar(21);
                $bar->start();
                $bar->advance();
                $this->callSilent('migrate:fresh');
                $bar->advance();
                Role::create([
                    'role'  => "Koordas"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "Software"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "Hardware"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "Koorprak"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "Admin 1"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "Admin 2"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "PJ SC ATC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "PJ SC HRD"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "PJ SC MLC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "PJ SC RDC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "SC ATC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "SC HRD"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "SC MLC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "SC RDC"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "A.T.C"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "H.R.D"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "M.L.C"
                ]);
                $bar->advance();
                Role::create([
                    'role'  => "R.D.C"
                ]);
                $bar->advance();
                Configuration::create([
                    'registrationPraktikan_activation' => 1,
                    'registrationAsisten_activation' => 1,
                ]);
                $bar->advance();
                $bar->finish();
                $this->info("\n\nInitialization Complete\n");
            }
        }
    }
}
