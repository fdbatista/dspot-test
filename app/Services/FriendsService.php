<?php

namespace App\Services;

use App\Repositories\FriendsRepository;
use App\Utils\GraphUtil;

class FriendsService
{
    public function __construct(private FriendsRepository $friendsRepository)
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
