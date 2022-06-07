<?php

namespace Tests\Unit;

use App\Utils\AlternateCharsUtil;
use PHPUnit\Framework\TestCase;

class AlternateCharsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_alternate_chars_will_return_three()
    {
        $string = 'AAABBB';
        $result = AlternateCharsUtil::alternatingCharacters($string);

        $this->assertEquals(4, $result);
    }
}
