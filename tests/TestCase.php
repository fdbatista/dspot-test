<?php

namespace Tests;

use App\Utils\JWTUtil;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public static function getJwt(): ?string
    {
        return JWTUtil::encodeJWT([
            'dummy' => Str::random(),
            'exp' => time() + 3600,
        ]);
    }
}
