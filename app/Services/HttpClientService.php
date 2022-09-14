<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\Pure;
use stdClass;

class HttpClientService
{
    public function sendRequest(string $url): object|array
    {
        try {
            $result = Http::get($url)->object();

            return (empty($result))
                ? self::returnEmptyResponse()
                : $result;
        } catch (Exception) {
            return self::returnEmptyResponse();
        }
    }

    #[Pure]
    private static function returnEmptyResponse(): object
    {
        $result = new stdClass();
        $result->results = [];

        return $result;
    }
}
