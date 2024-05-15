<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class AbstractRepository
{
    protected Model $model;
    public function __construct(string $modelFqcn)
    {
        $this->model = new $modelFqcn();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function getAllPaginated(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', int $page = null): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(string $field, $value)
    {
        return $this->model->where($field, $value)->get();
    }

    public function findOneBy(string $field, $value): ?Model
    {
        return $this->model->where($field, $value)->get()->first();
    }

    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    protected function getQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }
}
