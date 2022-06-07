<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Database\Eloquent\Model;
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

    public function find(int $id): ?Model
    {
        return $this->profileRepository->find($id);
    }
}
