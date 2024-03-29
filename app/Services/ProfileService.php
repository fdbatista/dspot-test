<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProfileService
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function all(): Collection
    {
        return $this->profileRepository->all();
    }

    public function find(int $id): ?Model
    {
        return $this->profileRepository->find($id);
    }

    public function findModels(array $ids): array
    {
        return array_map(function ($id) {
            $model = $this->profileRepository->find($id);

            return strval($model);
        }, $ids);
    }

    public function update(array $data)
    {
        $id = $data['id'];

        $this->profileRepository->update($data, $id);
    }

    public function create(array $data)
    {
        $this->profileRepository->insert($data);
    }
}
