<?php

namespace App\Http\Controllers;

use App\Exceptions\ResponseHandler;
use App\Utils\EmptyResponseEvaluator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use JetBrains\PhpStorm\Pure;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseHandler;

    protected function returnData(mixed $data): JsonResponse
    {
        $httpCode = $this->getResponseHttpCode($data);

        return $this->success($data, $httpCode);
    }

    #[Pure]
    private function getResponseHttpCode(mixed $data): int
    {
        return EmptyResponseEvaluator::isEmptyResponse($data)
            ? Response::HTTP_NO_CONTENT
            : Response::HTTP_OK;
    }
}
