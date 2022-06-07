<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
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

    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $data = $request->all(['id', 'phone', 'first_name', 'last_name', 'address', 'img', 'zip_code', 'city_id']);

        $this->profileService->update($data);

        return $this->success();
    }

    public function create(ProfileCreateRequest $request): JsonResponse
    {
        $data = $request->all(['phone', 'first_name', 'last_name', 'address', 'img', 'zip_code', 'city_id']);

        $this->profileService->create($data);

        return $this->success();
    }
}
