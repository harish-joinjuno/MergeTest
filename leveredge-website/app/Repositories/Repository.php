<?php


namespace App\Repositories;

use App\Exceptions\RepoModelNotSetException;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $model;

    /**
     * Repository constructor.
     * @throws RepoModelNotSetException
     */
    public function __construct()
    {
        if (! $this->model) {
            throw (new RepoModelNotSetException())->setRepo(get_called_class());
        }

        $this->model = new $this->model();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function new(): Model
    {
        $model = new $this->model();

        $model->save();

        return $model;
    }

    public function query()
    {
        return $this->model->newQuery();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function exists(int $id): bool
    {
        return $this->model->where('id', $id)->exists();
    }

    public function store(array $data = []): object
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail(int $id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function firstOrCreate(array $data = [])
    {
        return $this->model->firstOrCreate($data);
    }

    public function firstOrNew(array $data = [])
    {
        return $this->model->firstOrNew($data);
    }

    public function destroy(int $id)
    {
        $model = $this->find($id);

        return $model->delete();
    }

    public function has($col, $value): bool
    {
        return (boolean)($this->model->where($col, $value)->count());
    }

    public function pluck($value, $key = null, $orderBy = null)
    {
        return $this->model->orderBy($orderBy ?: $value)->pluck($value, $key);
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function findWith(int $id, $relatedModels)
    {
        return $this->model->with($relatedModels)->findOrFail($id);
    }

    public function allWith($with)
    {
        return $this->model->with($with)->get();
    }
}
