<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfileUpdateRequest extends FormRequest
{
    #[ArrayShape(['id' => "string", 'phone' => "string", 'first_name' => "string", 'last_name' => "string", 'address' => "string", 'img' => "string", 'zip_code' => "string", 'city_id' => "string"])]
    public function rules(): array
    {
        return [
            'id' => 'required|numeric',
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'img' => 'required',
            'zip_code' => 'required',
            'city_id' => 'required|numeric',
        ];
    }
}
