<?php

namespace App\Http\Controllers;

use App\Services\FriendsService;
use Illuminate\Http\JsonResponse;

class FriendsController extends Controller
{
    private FriendsService $friendsService;

    public function __construct(FriendsService $friendsService)
    {
        $this->friendsService = $friendsService;
    }

    public function findFriends(int $profileId): JsonResponse
    {
        $result = $this->friendsService->findFriends($profileId);

        return $this->success($result);
    }
}
