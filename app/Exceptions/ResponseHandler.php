<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ResponseHandler
{
    protected function success(mixed $data): JsonResponse
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
