<?php

namespace App\Repositories\_Core\Abstraction;

interface RepositoryInterface
{
    public function all();

    public function get(int $id);

    public function insert(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}
