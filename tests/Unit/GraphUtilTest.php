<?php

namespace Tests\Unit;

use App\Utils\GraphUtil;
use PHPUnit\Framework\TestCase;

class GraphUtilTest extends TestCase
{
    public function test_find_shortest_path_returns_three_hops()
    {
        $graph = [
            'Jon' => ['Arya', 'Sansa', 'Tyrion'],
            'Cersei' => ['Tyrion', 'Jamie'],
            'Sansa' => ['Little Finger', 'Jon', 'Arya'],
            'Arya' => ['Jon', 'Sansa'],
            'Tyrion' => ['Jamie', 'Cersei', 'Jon'],
            'Jamie' => ['Tyrion', 'Cersei'],
            'Little Finger' => ['Sansa'],
        ];

        $minHops = GraphUtil::findMinimumHops($graph, 'Jon', 'Jamie');

        $this->assertEquals(['Jon', 'Tyrion', 'Jamie'], $minHops);
    }
}
