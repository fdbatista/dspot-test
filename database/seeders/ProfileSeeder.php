<?php

namespace Database\Seeders;

use App\Repositories\FriendRepository;
use App\Repositories\ProfileRepository;
use App\Utils\MaxFriendsCalculatorUtil;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use OutOfRangeException;

class ProfileSeeder extends Seeder
{
    public function __construct(
        private ProfileFactory $profileFactory,
        private ProfileRepository $profileRepository,
        private FriendRepository $friendRepository,
    )
    {
    }

    public function run(int $profilesTotal, int $friendsTotal)
    {
        $this->raiseExceptionIfInvalidNumberOfConnections($profilesTotal, $friendsTotal);
        $this->runSeed($profilesTotal, $friendsTotal);
    }

    private function raiseExceptionIfInvalidNumberOfConnections(int $profilesTotal, int $friendsTotal) {
        $maxPossibleFriendsCombinations = MaxFriendsCalculatorUtil::findMaxCombinationsAvailable($profilesTotal);

        if ($friendsTotal > $maxPossibleFriendsCombinations) {
            throw new OutOfRangeException("$profilesTotal profiles cannot have more than $maxPossibleFriendsCombinations friends.");
        }
    }

    private function runSeed(int $profilesTotal, int $friendsTotal) {
        $profiles = $this->profileFactory->buildFakeProfiles($profilesTotal);

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
