<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Collection;

class ProfileService
{
    private ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function all(): Collection
    {
        return $this->profileRepository->all();
    }
}
