<?php

namespace Tests\Feature\Friends;

use App\Repositories\FriendRepository;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

class GetShortestPathEndpointTest extends TestCase
{
    public function test_get_shortest_path_returns_an_array()
    {
        $this->mock(FriendRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('getFriendsConnections')->once()->andReturn([]);
        });

        $response = $this->get('/api/v1/profiles/1/path/3');

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
