<?php

namespace Tests\Feature\Friends;

use App\Repositories\FriendRepository;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

class GetFriendsEndpointTest extends TestCase
{
    public function test_get_friends_returns_an_array()
    {
        $this->mock(FriendRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('findFriends')->once()->andReturn([]);
        });

        $response = $this->get('/api/v1/profiles/1/friends');

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
