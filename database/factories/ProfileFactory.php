<?php

namespace Database\Factories;

use App\Repositories\CityRepository;
use App\Repositories\StateRepository;
use App\Services\HttpClientService;
use Illuminate\Database\Eloquent\Model;

class ProfileFactory
{
    const PROFILE_GENERATOR_URL = 'https://randomuser.me/api/?nat=gb&inc=name,phone,picture,location&noinfo';

    public function __construct
    (
        private HttpClientService $httpService,
        private StateRepository $stateRepository,
        private CityRepository $cityRepository,
    )
    {
    }

    public function getFakeProfiles(int $profilesTotal): array
    {
        $responsePayload = $this->getApiResponse($profilesTotal);

        return $this->transformApiResponseToProfiles($responsePayload);
    }

    private function getApiResponse(int $profilesTotal): array
    {
        $url = self::PROFILE_GENERATOR_URL . "&results=$profilesTotal";
        $apiResponse = $this->httpService->sendRequest($url);

        return $apiResponse->results;
    }

    private function transformApiResponseToProfiles(array $apiUsers): array
    {
        return collect($apiUsers)
            ->map(function ($apiUser) {
                $nameAttributes = $apiUser->name;
                $location = $apiUser->location;

                $address = $this->extractAddressFromApiResponse($location);
                $state = $this->getOrCreateState($location->state);
                $city = $this->getOrCreateCity($state->id, $location->city);

                return [
                    'phone' => $apiUser->phone,
                    'first_name' => $nameAttributes->first,
                    'last_name' => $nameAttributes->last,
                    'address' => $address,
                    'img' => $apiUser->picture->medium,
                    'zip_code' => $location->postcode,
                    'city_id' => $city->id,
                ];
            })->toArray();
    }

    private function extractAddressFromApiResponse(object $location): string
    {
        $street = $location->street;

        return "$street->number $street->name";
    }

    private function getOrCreateState(string $stateTitle): Model
    {
        return $this->stateRepository->firstOrCreate(['title' => $stateTitle]);
    }

    private function getOrCreateCity(int $stateId, string $cityTitle): Model
    {
        return $this->cityRepository->firstOrCreate([
            'state_id' => $stateId,
            'title' => $cityTitle,
        ]);
    }
}
