<?php

namespace Tests\Feature;

use App\Services\ProfileService;
use Illuminate\Support\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class GetProfilesEndpointTest extends TestCase
{
    public function test_get_consultants_with_valid_token_returns_collection()
    {
        $this->mock(ProfileService::class, function (MockInterface $mock) {
            $mock->shouldReceive('all')->once()->andReturn(new Collection());
        });

        $response = $this->get('/api/v1/profile');

        $response->assertJsonPath('success', true);
    }
}
