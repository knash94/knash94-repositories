<?php

namespace Knash94\Repositories;

use Illuminate\Contracts\Cache\Repository as Cache;

class BaseCacheRepository implements BaseRepositoryContract
{

    /**
     * @var baseEloquentRepository
     */
    private $repository;
    /**
     * @var Cache
     */
    private $cache;

    protected $model;

    public function __construct(BaseEloquentRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
        $this->repository->makeModel($this->model);
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
        $key = $this->getCacheKey('count');
        return $this->cache->tags($this->getModelName())->remember($key, 5, function(){
            return $this->repository->count();
        });
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
        $key = $this->getCacheKey($column . $value);
        return $this->cache->tags($this->getModelName())->remember($key, 5, function() use($column, $value){
            return $this->repository->countWhere($column, $value);
        });
    }

    /**
     * Find model by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $key = $this->getCacheKey($id);
        return $this->cache->tags($this->getModelName())->remember($key, 5, function() use ($id){
           return $this->repository->findById($id);
        });
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
        return $this->repository->updateById($id, $attributes);
    }

    /**
     * Create a model from given attributes
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * Get models from query builder
     *
     * @return mixed
     */
    public function get()
    {
        return $this->cache->tags($this->getModelName())->remember($this->getCacheKey(), 5, function(){
           return $this->repository->get();
        });
    }

    /**
     * Add a group to the query
     *
     * @param $columns
     * @return mixed
     */
    public function groupBy($columns)
    {
        $this->repository->groupBy($columns);
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
        $this->repository->limit($limit);
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
        $this->repository->orderBy($column, $direction);
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
        $this->repository->select($columns);
        return $this;
    }

    /**
     * Add where clause to the query
     *
     * @param $column
     * @param null $operator
     * @param $value
     * @param string $boolean
     * @return mixed
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->repository->where($column, $operator, $value, $boolean);
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
        return $this->repository->createMultiple($data);
    }

    /**
     * Load relations with model
     *
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        $this->repository->with($relations);
        return $this;
    }

    private function getModelName()
    {
        return $this->repository->getModelName();
    }

    private function getCacheKey($add = ''){
        return hash('sha256',
            $this->repository->query()->toSql() . $add
        );
    }
}