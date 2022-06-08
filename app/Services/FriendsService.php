<?php

namespace App\Services;

use App\Repositories\FriendsRepository;

class FriendsService
{
    private FriendsRepository $friendsRepository;

    public function __construct(FriendsRepository $friendsRepository)
    {
        $this->friendsRepository = $friendsRepository;
    }

    public function findFriends(int $profileId): array
    {
        return $this->friendsRepository->findFriends($profileId);
    }
}
