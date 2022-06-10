<?php

namespace Tests\Feature\Profile;

use App\Models\Constants\ProfileErrors;
use App\Repositories\CityRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Response;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateProfileEndpointTest extends TestCase
{
    public function test_update_profile_returns_validation_error()
    {
        $this->mock(CityRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('exists')->once()->andReturn(true);
        });

        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('isNotUnique')->once()->andReturn(true);
        });

        $response = $this->put('/api/v1/profiles', []);

        $response->assertSeeText(ProfileErrors::EXISTING_MODEL);
    }

    public function test_update_profile_returns_successful_message()
    {
        $this->mock(CityRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('exists')->once()->andReturn(true);
        });

        $this->mock(ProfileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('isNotUnique')->once()->andReturn(false);
            $mock->shouldReceive('update')->once();
        });

        $response = $this->put('/api/v1/profiles', [
            'id' => 1,
            'phone' => '0018946545',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '223 Baker St',
            'img' => 'https://image.to',
            'zip_code' => 3312,
            'city_id' => 1,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
