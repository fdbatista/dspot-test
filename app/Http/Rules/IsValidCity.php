<?php

namespace App\Http\Rules;

use App\Repositories\CityRepository;
use Illuminate\Contracts\Validation\Rule;

class IsValidCity implements Rule
{
    private const MESSAGE = 'City ID needs to be valid.';

    public function __construct(public ?int $cityId, private CityRepository $cityRepository)
    {
    }

    public function passes($attribute, $value): bool
    {
        return $this->cityRepository->exists(['id' => $this->cityId]);
    }

    public function message(): string
    {
        return self::MESSAGE;
    }
}
