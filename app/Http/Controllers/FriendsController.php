<?php

namespace App\Http\Controllers;

use App\Services\FriendsService;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class FriendsController extends Controller
{
    public function __construct(
        private FriendsService $friendsService,
        private ProfileService $profileService,
    )
    {
    }

    public function findFriends(int $profileId): JsonResponse
    {
        $data = $this->friendsService->findFriends($profileId);

        return $this->returnData($data);
    }

    public function findShorterPath(int $profileId, int $friendId): JsonResponse
    {
        $hops = $this->friendsService->findShorterPath($profileId, $friendId);
        $data = $this->profileService->findModels($hops);

        return $this->returnData($data);
    }
}
