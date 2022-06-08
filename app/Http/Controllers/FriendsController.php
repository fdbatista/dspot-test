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
        $result = $this->friendsService->findFriends($profileId);

        return $this->success($result);
    }

    public function findShorterPath(int $origin, int $destination): JsonResponse
    {
        $hops = $this->friendsService->findShorterPath($origin, $destination);
        $result = $this->profileService->findModels($hops);

        return $this->success($result);
    }
}
