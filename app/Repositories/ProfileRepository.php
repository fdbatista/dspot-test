<?php

namespace App\Repositories;

use App\Models\Constants\ProfileConstants;
use App\Models\Entities\Profile;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class ProfileRepository extends AbstractRepository
{
    #[Pure]
    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        $query = $this->getModelQuery();

        return $query->get();
    }

    public function find($id): Model|Builder|null
    {
        $query = $this->getModelQuery();

        return $query
            ->where('profile.id', $id)
            ->first();
    }

    private function getModelQuery(): Builder
    {
        return $this->model::query()
            ->join('city', 'profile.city_id', '=', 'city.id')
            ->join('state', 'city.state_id', '=', 'state.id')
            ->select(ProfileConstants::PROFILE_ATTRIBS_TO_RETURN);
    }

    public function findAllPossibleConnections(): Collection
    {
        return $this->model::query()
            ->crossJoin('profile as f', 'profile.id', '<', 'f.id')
            ->select(['profile.id as profile_id', 'f.id as friend_id'])
            ->get();
    }
}
