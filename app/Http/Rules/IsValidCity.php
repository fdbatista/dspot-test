<?php

namespace App\Http\Rules;

use App\Repositories\CityRepository;
use Illuminate\Contracts\Validation\Rule;

class IsValidCity implements Rule
{
    public ?int $cityId;
    private CityRepository $cityRepository;

    public function __construct(?int $cityId, CityRepository $cityRepository)
    {
        $this->cityId = $cityId;
        $this->cityRepository = $cityRepository;
    }

    public function passes($attribute, $value): bool
    {
        return $this->cityRepository->exists(['id' => $this->cityId]);
    }

    public function message(): string
    {
        return 'City ID needs to be valid.';
    }
}
