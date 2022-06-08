<?php

namespace Tests\Feature\Friends;

use App\Repositories\FriendsRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class GetFriendsEndpointTest extends TestCase
{
    public function test_get_friends_returns_an_array()
    {
        $this->mock(FriendsRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('findFriends')->once()->andReturn([]);
        });

        $response = $this->get('/api/v1/friends/1');

        $response->assertStatus(200);
    }
}