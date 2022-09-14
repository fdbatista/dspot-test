<?php

namespace App\Http\Controllers;

use App\Services\FriendService;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class FriendsController extends Controller
{
    public function __construct(
        private FriendService $friendService,
        private ProfileService $profileService,
    )
    {
    }

    public function findFriends(int $id): JsonResponse
    {
        $data = $this->friendService->findFriends($id);

        return $this->returnData($data);
    }

    public function findShorterPath(int $id, int $friendId): JsonResponse
    {
        $hops = $this->friendService->findShorterPath($id, $friendId);
        $data = $this->profileService->findModels($hops);

        return $this->returnData($data);
    }
}
