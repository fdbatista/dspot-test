<?php

namespace App\Repositories\_Core\Abstraction;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function insert(array $data): void
    {
        $this->model::insert($data);
    }

    public function update(array $data, int $id): void
    {
        $this->model::where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        $this->model::find($id)->delete();
    }

    public function get(int $id)
    {
        return $this->model::find($id);
    }

    public function exists(array $criteria)
    {
        return $this->model::where($criteria)->exists();
    }

    public function updateOrCreate(array $compareAttribs, array $fillAttribs)
    {
        return $this->model::updateOrCreate($compareAttribs, $fillAttribs);
    }

    public function firstOrCreate(array $compareAttribs, array $fillAttribs = []): Model
    {
        return $this->model::firstOrCreate($compareAttribs, $fillAttribs);
    }

    public function firstOrFail(array $data)
    {
        return $this->model::firstOrFail($data);
    }

    public function findOne(array $criteria)
    {
        return $this->model::where($criteria)->first();
    }

    public function findAll(array $criteria)
    {
        return $this->model::where($criteria)->get();
    }

    public function whereIn(string $column, array $ids): Builder
    {
        return $this->model::query()->whereIn($column, $ids);
    }
}
