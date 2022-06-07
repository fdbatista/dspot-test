<?php

namespace Tests\Feature;

use App\Models\Constants\ProfileConstants;
use App\Repositories\CityRepository;
use App\Repositories\ProfileRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateProfileEndpointTest extends TestCase
{
    public function test_update_profile_returns_validation_error()
    {
        $response = $this->put('/api/v1/profile', []);

        $response->assertSeeText('required');
    }

    public function test_update_profile_returns_successful_message()
    {
        $this->mock(CityRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('exists')->once()->andReturn(true);
        });

        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('update')->once();
        });

        $response = $this->put('/api/v1/profile', [
            'id' => 1,
            'phone' => '0018946545',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '223 Baker St',
            'img' => 'https://image.to',
            'zip_code' => 3312,
            'city_id' => 1,
        ]);

        $response->assertSeeText(ProfileConstants::SUCCESSFUL_OPERATION_MESSAGE);
    }
}
