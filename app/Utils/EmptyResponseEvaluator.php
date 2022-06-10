<?php

namespace App\Utils;

class EmptyResponseEvaluator
{
    public static function isEmptyResponse(mixed $data): bool
    {
        if (is_countable($data) && count($data) === 0) {
            return true;
        }

        return empty($data);
    }
}
