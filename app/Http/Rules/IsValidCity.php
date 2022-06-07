<?php

namespace App\Http\Rules;

use App\Models\Entities\City;
use Illuminate\Contracts\Validation\Rule;

class IsValidCity implements Rule
{
    public int $cityId;

    public function __construct(int $cityId)
    {
        $this->cityId = $cityId;
    }

    public function passes($attribute, $value): bool
    {
        return (bool)City::find($this->cityId);
    }

    public function message(): string
    {
        return 'City ID needs to be valid.';
    }
}
