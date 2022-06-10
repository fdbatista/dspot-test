<?php

namespace Tests\Feature\Profile;

use App\Models\Constants\ProfileConstants;
use App\Models\Constants\ProfileErrors;
use App\Repositories\CityRepository;
use App\Repositories\ProfileRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProfileEndpointTest extends TestCase
{
    public function test_create_profile_returns_validation_error()
    {
        $response = $this->post('/api/v1/profiles', []);

        $response->assertSeeText(ProfileErrors::INVALID_CITY);
    }

    public function test_create_profile_returns_successful_message()
    {
        $this->mock(CityRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('exists')->once()->andReturn(true);
        });

        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('isNotUnique')->once()->andReturn(false);
            $mock->shouldReceive('insert')->once();
        });

        $response = $this->post('/api/v1/profiles', [
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
