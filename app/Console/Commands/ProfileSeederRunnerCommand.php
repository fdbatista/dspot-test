<?php

namespace App\Console\Commands;

use Database\Seeders\ProfileSeeder;
use Illuminate\Console\Command;

class ProfileSeederRunnerCommand extends Command
{
    protected $signature = 'profiles:seed {profilesTotal} {friendsTotal}';

    protected $description = 'Command description';

    public function handle(ProfileSeeder $seeder)
    {
        $profilesTotal = $this->argument('profilesTotal');
        $friendsTotal = $this->argument('friendsTotal');

        $seeder->run($profilesTotal, $friendsTotal);
    }
}
