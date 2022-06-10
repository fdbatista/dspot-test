<?php

namespace Tests\Feature\Profile;

use App\Repositories\ProfileRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class GetAllProfilesEndpointTest extends TestCase
{
    public function test_get_profiles_returns_collection()
    {
        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('all')->once()->andReturn(new Collection([['id' => 1]]));
        });

        $response = $this->get('/api/v1/profiles');

        $response->assertJsonCount(1);
    }
}
