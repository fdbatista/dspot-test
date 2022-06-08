<?php

namespace App\Repositories;

use App\Models\Entities\State;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use JetBrains\PhpStorm\Pure;

class StateRepository extends AbstractRepository
{
    #[Pure]
    public function __construct(State $model)
    {
        parent::__construct($model);
    }
}
