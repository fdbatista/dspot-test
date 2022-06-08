<?php

namespace App\Http\Controllers;

use App\Services\FriendsService;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class FriendsController extends Controller
{
    public function __construct(
        private FriendsService $friendsService,
        private ProfileService $profileService
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

        $result = array_map(function ($hop) {
            return $this->getProfileDescription($hop);
        }, $hops);

        return $this->success($result);
    }

    private function getProfileDescription(int $id): string {
        $profileModel = $this->profileService->find($id);

        return $profileModel->first_name . ' ' . $profileModel->last_name . ' - ' . $profileModel->id;
    }
}
