<?php

namespace App\Exceptions;

use App\Models\Constants\ProfileConstants;
use Illuminate\Http\JsonResponse;
use Throwable;

trait ResponseHandler
{
    protected function success(mixed $data = ProfileConstants::SUCCESSFUL_OPERATION_MESSAGE): JsonResponse
    {
        return response()
            ->json($data)
            ->setStatusCode(200);
    }

    protected function error(Throwable $exception, int $httpCode = 400): JsonResponse
    {
        return response()
            ->json($exception->getMessage())
            ->setStatusCode($httpCode);
    }
}
