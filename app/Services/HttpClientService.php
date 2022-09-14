<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpClientService
{
    public function sendRequest(string $url): object|array
    {
        return Http::get($url)->object();
    }
}
