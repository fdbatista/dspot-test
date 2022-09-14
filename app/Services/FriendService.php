<?php

namespace App\Services;

use App\Repositories\FriendRepository;
use App\Utils\GraphUtil;

class FriendService
{
    public function __construct(private FriendRepository $friendsRepository)
    {
    }

    public function findFriends(int $profileId): array
    {
        return $this->friendsRepository->findFriends($profileId);
    }

    public function findShorterPath(int $origin, int $destination): array
    {
        $graph = $this->friendsRepository->getFriendsConnections();

        return GraphUtil::findMinimumHops($graph, $origin, $destination);
    }
}
