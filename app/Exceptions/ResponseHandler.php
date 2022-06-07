<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ResponseHandler
{
    protected function success($data): JsonResponse
    {
        $responseData = [
            'success' => true,
            'data' => $data,
        ];

        return response()
            ->json($responseData)
            ->setStatusCode(200);
    }

    protected function error(Throwable $exception, int $httpCode = 400): JsonResponse
    {
        $responseData = [
            'success' => false,
            'error' => $exception->getMessage(),
        ];

        return response()
            ->json($responseData)
            ->setStatusCode($httpCode);
    }
}
