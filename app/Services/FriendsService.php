<?php

namespace App\Services;

use App\Repositories\FriendsRepository;

class FriendsService
{
    public function __construct(private FriendsRepository $friendsRepository)
    {
    }

    public function findFriends(int $profileId): array
    {
        return $this->friendsRepository->findFriends($profileId);
    }
}
