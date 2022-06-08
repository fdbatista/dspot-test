<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpClientService
{
    function sendRequest(string $url): object|array
    {
        return Http::get($url)->object();
    }
}
