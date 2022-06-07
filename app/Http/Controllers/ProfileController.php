<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function all(): JsonResponse
    {
        $data = $this->profileService->all();

        return $this->success($data);
    }

    public function find(int $id): JsonResponse
    {
        $data = $this->profileService->find($id);

        return $this->success($data);
    }
}
