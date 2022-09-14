<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Constants\ProfileConstants;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $profileService)
    {
    }

    public function all(): JsonResponse
    {
        $data = $this->profileService->all();

        return $this->returnData($data);
    }

    public function find(int $id): JsonResponse
    {
        $data = $this->profileService->find($id);

        return $this->returnData($data);
    }

    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $data = $request->all(['id', 'phone', 'first_name', 'last_name', 'address', 'img', 'zip_code', 'city_id']);
        $this->profileService->update($data);

        return $this->success(ProfileConstants::SUCCESSFUL_OPERATION_MESSAGE, Response::HTTP_CREATED);
    }

    public function create(ProfileCreateRequest $request): JsonResponse
    {
        $data = $request->all(['phone', 'first_name', 'last_name', 'address', 'img', 'zip_code', 'city_id']);
        $this->profileService->create($data);

        return $this->success(
            ProfileConstants::SUCCESSFUL_OPERATION_MESSAGE,
            Response::HTTP_CREATED
        );
    }
}
