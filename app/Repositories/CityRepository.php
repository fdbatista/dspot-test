<?php

namespace App\Repositories;

use App\Models\Entities\City;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use JetBrains\PhpStorm\Pure;

class CityRepository extends AbstractRepository
{
    #[Pure]
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}
