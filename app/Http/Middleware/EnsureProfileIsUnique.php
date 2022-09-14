<?php

namespace App\Http\Middleware;

use App\Models\Constants\ProfileErrors;
use App\Repositories\ProfileRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureProfileIsUnique
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $id = $request->input('id', 0);
        $uniqueAttribs = $request->all(['first_name', 'last_name', 'phone']);

        $exists = $this->profileRepository->isNotUnique($id, $uniqueAttribs);
        abort_if($exists, Response::HTTP_BAD_REQUEST, ProfileErrors::EXISTING_MODEL);

        return $next($request);
    }
}
