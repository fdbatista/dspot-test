<?php

namespace Database\Seeders;

use App\Repositories\ProfileRepository;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function __construct(
        private ProfileFactory $profileFactory,
        private ProfileRepository $profileRepository,
    )
    {
    }

    public function run(int $profilesTotal, int $friendsTotal)
    {
        $users = $this->profileFactory->getFakeProfiles($profilesTotal);

        DB::transaction(function () use ($users) {
            $this->profileRepository->deleteAll();
            $this->profileRepository->insert($users);
        });
    }
}
