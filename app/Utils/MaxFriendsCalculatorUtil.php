<?php

namespace App\Utils;

class MaxFriendsCalculatorUtil
{
    public static function findMaxCombinationsAvailable(int $profilesTotal): int
    {
        $range = range(1, $profilesTotal - 1);

        return array_reduce($range, function ($carry, $item) {
            $carry += $item;
            return $carry;
        }, 0);
    }
}
