<?php

namespace App\Http\Middleware;

use App\Models\Constants\ProfileErrors;
use App\Repositories\CityRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureCityIsValid
{
    public function __construct(private CityRepository $cityRepository)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $cityId = $request->get('city_id', 0);
        $cityExists = $this->cityRepository->exists(['id' => $cityId]);

        abort_unless($cityExists, Response::HTTP_BAD_REQUEST, ProfileErrors::INVALID_CITY);

        return $next($request);
    }
}
