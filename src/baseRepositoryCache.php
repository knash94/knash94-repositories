<?php
/**
 * Created by PhpStorm.
 * User: KyleN
 * Date: 14/01/2017
 * Time: 18:56
 */

namespace knash94\repositories;

use Illuminate\Contracts\Cache\Repository as Cache;

class baseRepositoryCache implements baseRepositoryContract
{

    /**
     * @var baseRepositoryEloquent
     */
    private $repository;
    /**
     * @var Cache
     */
    private $cache;

    protected $model;

    public function __construct(baseRepositoryEloquent $repository, Cache $cache)
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
        $key = $this->getCacheKey() . 'count';
        return $this->cache->remember($key, 5, function(){
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
        $key = $this->getCacheKey() . $column . $value;

        // TODO: Implement countWhere() method.
    }

    /**
     * Find model by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->cache->remember('users.' . $id, 5, function($id = 2){
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
        var_dump('cache key: ' . $this->getCacheKey());
        return $this->cache->remember($this->getCacheKey(), 5, function(){
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
        // TODO: Implement groupBy() method.
    }

    /**
     * Add a limit to the query
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit)
    {
        // TODO: Implement limit() method.
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
        // TODO: Implement orderBy() method.
    }

    /**
     * Select given columns
     *
     * @param array $columns
     * @return mixed
     */
    public function select($columns = ['*'])
    {
        // TODO: Implement select() method.
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
        // TODO: Implement where() method.
    }

    /**
     * Create multiple models from array
     *
     * @param array $data
     * @return mixed
     */
    public function createMultiple(array $data)
    {
        // TODO: Implement createMultiple() method.
    }

    /**
     * Load relations with model
     *
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        // TODO: Implement with() method.
    }

    private function getModelName()
    {
        return $this->repository->getModelName();
    }

    private function getCacheKey(){
        return hash('sha256',
            $this->repository->query()->toSql()
        );
    }
}