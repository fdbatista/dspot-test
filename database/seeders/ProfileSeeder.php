<?php

namespace Database\Seeders;

use App\Repositories\FriendRepository;
use App\Repositories\ProfileRepository;
use App\Utils\MaxFriendsCalculatorUtil;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

    private function raiseExceptionIfInvalidNumberOfConnections(int $profilesTotal, int $friendsTotal)
    {
        $maxPossibleFriendsCombinations = MaxFriendsCalculatorUtil::findMaxCombinationsAvailable($profilesTotal);
        $error = "$profilesTotal profiles cannot have more than $maxPossibleFriendsCombinations friends.";

        abort_if($friendsTotal > $maxPossibleFriendsCombinations, Response::HTTP_BAD_REQUEST, $error);
    }

    private function runSeed(int $profilesTotal, int $friendsTotal)
    {
        $profiles = $this->profileFactory->buildFakeProfiles($profilesTotal);

        if (empty($profiles)) {
            echo "Empty response received from RandomUser API.\n";
        }
        else {
            DB::transaction(function () use ($profiles, $friendsTotal) {
                $this->createProfiles($profiles);
                $this->createRandomConnections($friendsTotal);
            });
        }
    }

    private function createProfiles(array $profiles)
    {
        $this->profileRepository->deleteAll();
        $this->profileRepository->insert($profiles);
    }

    private function createRandomConnections(int $friendsTotal)
    {
        $allPossibleConnections = $this->profileRepository->findAllPossibleConnections();
        $randomConnections = $allPossibleConnections
            ->shuffle()
            ->random($friendsTotal)
            ->toArray();

        $this->friendRepository->insert($randomConnections);
    }
}
