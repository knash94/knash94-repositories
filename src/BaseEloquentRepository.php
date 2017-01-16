<?php

namespace Knash94\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BaseEloquentRepository implements BaseRepositoryContract
{

    /**
     * Eloquent model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Query Builder Instance
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    public function __construct(){
        $this->makeModel($this->model);
    }
    /**
     * Get all models
     *
     * @return mixed
     */
    public function all()
    {
        return $this->get();
    }

    /**
     * Count all models
     *
     * @return mixed
     */
    public function count()
    {
        return $this->get()->count();
    }

    /**
     * Count where a column matches a value
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function countWhere($column, $value)
    {
        return $this->where($column, $value)->count();
    }

    /**
     * Find model by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $model = $this->query()->findOrFail($id);
        $this->query = null;
        return $model;
    }

    /**
     * Update model by id
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function updateById($id, array $attributes)
    {
        $this->query = null;
        $model = $this->findById($id);
        $model->update($attributes);
        return $model;
    }

    /**
     * Create a model from given attributes
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $this->query = null;
        return $this->model->create($attributes);
    }

    /**
     * Get models from query builder
     *
     * @return mixed
     */
    public function get()
    {
        $models = $this->query()->get();
        $this->query = null;
        return $models;
    }

    /**
     * Add a group to the query
     *
     * @param $columns
     * @return mixed
     */
    public function groupBy($columns)
    {
        $this->query()->groupBy($columns);
        return $this;
    }

    /**
     * Add a limit to the query
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit)
    {
        $this->query()->limit($limit);
        return $this;
    }

    /**
     * Add an orderBy to the query
     *
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->query()->orderBy($column, $direction);
        return $this;
    }

    /**
     * Select given columns
     *
     * @param array $columns
     * @return mixed
     */
    public function select($columns = ['*'])
    {
        $this->query()->select($columns);
        return $this;
    }

    /**
     * Add where clause to the query
     *
     * @param $column
     * @param $operator
     * @param $value
     * @param string $boolean
     * @return mixed
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->query()->where($column, $operator, $value, $boolean);
        return $this;
    }

    /**
     * Create multiple models from array
     *
     * @param array $data
     * @return mixed
     */
    public function createMultiple(array $data)
    {
        $models = new Collection();
        foreach($data as $item){
            $models->push($this->create($item));
        }
        return $models;
    }

    /**
     * Load relations with model
     *
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        $this->query()->with($relations);
        return $this;
    }

    public function getModelName()
    {
        return get_class($this->model);
    }

    public function makeModel($model){
        $this->model = app()->make($model);
    }

    public function query()
    {
        if($this->query instanceof Builder)
        {
            return $this->query;
        }
        $this->query = $this->model->newQuery();
        return $this->query;
    }
}