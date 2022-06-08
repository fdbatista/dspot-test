<?php

namespace Tests\Feature\Friends;

use App\Repositories\FriendsRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class GetShortestPathEndpointTest extends TestCase
{
    public function test_get_shortest_path_returns_an_array()
    {
        $this->mock(FriendsRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('getFriendsConnections')->once()->andReturn([]);
        });

        $response = $this->get('/api/v1/friends/path/1/3');

        $response->assertJson([]);
    }
}
