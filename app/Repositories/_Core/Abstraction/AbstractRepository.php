<?php

namespace App\Repositories\_Core\Abstraction;

use Illuminate\Database\Eloquent\Builder;
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
        $this->model::query()->insert($data);
    }

    public function update(array $data, int $id): void
    {
        $this->model::query()->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        $this->model::query()->find($id)->delete();
    }

    public function get(int $id): Model|Collection|Builder|array|null
    {
        return $this->model::query()->find($id);
    }

    public function exists(array $criteria): bool
    {
        return $this->model::query()->where($criteria)->exists();
    }

    public function updateOrCreate(array $compareAttribs, array $fillAttribs): Model|Builder
    {
        return $this->model::query()->updateOrCreate($compareAttribs, $fillAttribs);
    }

    public function firstOrCreate(array $compareAttribs, array $fillAttribs = []): Model
    {
        return $this->model::query()->firstOrCreate($compareAttribs, $fillAttribs);
    }

    public function firstOrFail(array $data): Model|Builder
    {
        return $this->model::query()->firstOrFail($data);
    }

    public function findOne(array $criteria): Model|Builder|null
    {
        return $this->model::query()->where($criteria)->first();
    }

    public function findAll(array $criteria): Collection|array
    {
        return $this->model::query()->where($criteria)->get();
    }

    public function whereIn(string $column, array $ids): Builder
    {
        return $this->model::query()->whereIn($column, $ids);
    }

    public function deleteAll()
    {
        $this->model::query()->delete();
    }
}
