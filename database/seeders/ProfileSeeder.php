<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProfileSeeder extends Seeder
{
    public function run(int $profilesTotal, int $friendsTotal)
    {
        Log::debug("Seeder params", [$profilesTotal, $friendsTotal]);
    }
}
