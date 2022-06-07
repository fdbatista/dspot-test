<?php

namespace App\Http\Requests;

use App\Http\Rules\IsValidCity;
use App\Repositories\CityRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class ProfileCreateRequest extends FormRequest
{
    #[ArrayShape(['phone' => "string", 'first_name' => "string", 'last_name' => "string", 'address' => "string", 'img' => "string", 'zip_code' => "string", 'city_id' => "string"])]
    public function rules(Request $request, CityRepository $cityRepository): array
    {
        $cityId = $request->get('city_id');

        return [
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'img' => 'required',
            'zip_code' => 'required',
            'city_id' => ['required', 'numeric', new IsValidCity($cityId, $cityRepository)],
        ];
    }
}
