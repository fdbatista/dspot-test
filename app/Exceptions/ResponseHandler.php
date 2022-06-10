<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

trait ResponseHandler
{
    protected function success(mixed $data, int $httpCode): JsonResponse
    {
        return response()
            ->json($data)
            ->setStatusCode($httpCode);
    }

    protected function error(Throwable $exception, int $httpCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()
            ->json($exception->getMessage())
            ->setStatusCode($httpCode);
    }
}
