<?php

namespace App\Repositories;

use App\Models\Entities\Friend;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use Illuminate\Support\Facades\DB;

class FriendsRepository extends AbstractRepository
{
    private string $tableName;

    public function __construct(Friend $model)
    {
        parent::__construct($model);

        $this->tableName = $model->getTable();
    }

    public function findFriends(int $profileId): array
    {
        $queryForIdOnProfile = DB::table($this->tableName)
            ->select(['friend_id'])
            ->where('profile_id', $profileId);

        $queryForIdOnFriend = DB::table($this->tableName)
            ->select(['profile_id as friend_id'])
            ->where('friend_id', $profileId);

        $union = $queryForIdOnProfile->unionAll($queryForIdOnFriend);

        return DB::table('profile')
            ->joinSub($union, 'c1', function ($join) {
                $join->on('profile.id', '=', 'c1.friend_id');
            })
            ->select(['profile.id', 'profile.first_name', 'profile.last_name'])
            ->orderBy('friend_id')
            ->get()
            ->values()
            ->toArray();
    }
}
