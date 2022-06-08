<?php

namespace Tests\Unit;

use App\Utils\MaxFriendsCalculatorUtil;
use PHPUnit\Framework\TestCase;

class MaxFriendsCalculatorUtilTest extends TestCase
{
    public function test_max_friends_calculator_returns_ten()
    {
        $profilesTotal = 5;
        $result = MaxFriendsCalculatorUtil::findMaxCombinationsAvailable($profilesTotal);

        $this->assertEquals(10, $result);
    }
}
