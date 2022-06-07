<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getConsultants(): JsonResponse
    {
        $data = $this->userService->getConsultants();

        return $this->success($data);
    }
}
