<?php


namespace App\Repositories\Contracts;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @return Model
     */
    public function new(): Model;

    /**
     * @return mixed
     */
    public function query();

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function exists(int $id): bool;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data = []): Object;

    /**
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * @param int $id
     * @param array|string[] $columns
      *
     * @return mixed
     */
    public function find(int $id, array $columns = ['*']);

    /**
     * @param int $id
     * @param array|string[] $columns
     *
     * @return mixed
     */
    public function findOrFail(int $id, array $columns = ['*']);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function firstOrCreate(array $data = []);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function firstOrNew(array $data = []);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param $col
     * @param $value
     *
     * @return boolean
     */
    public function has($col, $value): bool;

    /**
     * @param $value
     * @param null $key
     * @param null $orderBy
     *
     * @return mixed
     */
    public function pluck($value, $key = null, $orderBy = null);

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug(string $slug);

    /**
     * @param int $id
     * @param string|array $relatedModels
     *
     * @return mixed
     */
    public function findWith(int $id, $relatedModels);

    /**
     * @param string|array $with
     *
     * @return mixed
     */
    public function allWith($with);
}
