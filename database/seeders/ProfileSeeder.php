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

        DB::transaction(function () use ($profiles, $friendsTotal) {
            $this->createProfiles($profiles);
            $this->createRandomConnections($friendsTotal);
        });
    }

    private function createProfiles(array $profiles) {
        $this->profileRepository->deleteAll();
        $this->profileRepository->insert($profiles);
    }

    private function createRandomConnections(int $friendsTotal) {
        $allPossibleConnections = $this->profileRepository->findAllPossibleConnections();
        $randomConnections = $allPossibleConnections->random($friendsTotal)->toArray();

        $this->friendRepository->insert($randomConnections);
    }
}
