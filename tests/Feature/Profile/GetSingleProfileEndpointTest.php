<?php

namespace Tests\Feature\Profile;

use App\Models\Entities\Profile;
use App\Repositories\ProfileRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class GetSingleProfileEndpointTest extends TestCase
{
    public function test_get_a_single_profile_returns_object()
    {
        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('find')->once()->andReturn(new Profile(['id' => 1]));
        });

        $response = $this->get('/api/v1/profiles/1');

        $response->assertStatus(200);
    }
}
