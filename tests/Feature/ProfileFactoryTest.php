<?php

namespace Tests\Feature;

use App\Models\Entities\City;
use App\Models\Entities\State;
use App\Repositories\CityRepository;
use App\Repositories\StateRepository;
use App\Services\HttpClientService;
use Database\Factories\ProfileFactory;
use Mockery\MockInterface;
use Tests\TestCase;

class ProfileFactoryTest extends TestCase
{
    private const MOCKED_RESPONSE = [
        'results' => [
            [
                "name" => [
                    "title" => "Ms",
                    "first" => "Laura",
                    "last" => "Vargas"
                ],
                "location" => [
                    "street" => [
                        "number" => 6075,
                        "name" => "Church Street"
                    ],
                    "city" => "Gloucester",
                    "state" => "Grampian",
                    "country" => "United Kingdom",
                    "postcode" => "I06 3QG",
                    "coordinates" => [
                        "latitude" => "-67.4072",
                        "longitude" => "131.9412"
                    ],
                    "timezone" => [
                        "offset" => "-3 => 00",
                        "description" => "Brazil, Buenos Aires, Georgetown"
                    ]
                ],
                "email" => "laura.vargas@example.com",
                "phone" => "013873 70431",
                "picture" => [
                    "large" => "https => //randomuser.me/api/portraits/women/45.jpg",
                    "medium" => "https => //randomuser.me/api/portraits/med/women/45.jpg",
                    "thumbnail" => "https => //randomuser.me/api/portraits/thumb/women/45.jpg"
                ]
            ]
        ],
    ];

    public function test_random_user_api_returns_one_element_array()
    {
        $httpClient = $this->mockHttpClient();
        $stateRepository = $this->mockStateRepository();
        $cityRepository = $this->mockCityRepository();

        $service = new ProfileFactory($httpClient, $stateRepository, $cityRepository);
        $response = $service->getFakeProfiles(1);

        $this->assertEquals('6075 Church Street', $response[0]['address']);
        $this->assertEquals('Laura', $response[0]['first_name']);
        $this->assertEquals('Vargas', $response[0]['last_name']);
    }

    private function mockHttpClient(): MockInterface
    {
        return $this->mock(HttpClientService::class, function (MockInterface $mock) {
            $apiResponseAsObject = json_decode(json_encode(self::MOCKED_RESPONSE));

            $mock->shouldReceive('sendRequest')->once()->andReturn($apiResponseAsObject);
        });
    }

    private function mockStateRepository(): MockInterface
    {
        return $this->mock(StateRepository::class, function (MockInterface $mock) {
            $state = new State();
            $state->id = 1;

            $mock->shouldReceive('firstOrCreate')->andReturn($state);
        });
    }

    private function mockCityRepository(): MockInterface
    {
        return $this->mock(CityRepository::class, function (MockInterface $mock) {
            $city = new City(['id' => 1]);
            $city->id = 1;

            $mock->shouldReceive('firstOrCreate')->once()->andReturn($city);
        });
    }
}
