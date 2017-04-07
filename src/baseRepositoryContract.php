<?php

namespace Knash94\Repositories;

interface BaseRepositoryContract
{
    /**
     * Get all models
     *
     * @return mixed
     */
    public function all();

    /**
     * Count all models
     *
     * @return mixed
     */
    public function count();

    /**
     * Count where a column matches a value
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function countWhere($column, $value);

    /**
     * Find model by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Update model by id
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function updateById($id, array $attributes);

    /**
     * Create a model from given attributes
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Get models from query builder
     *
     * @return mixed
     */
    public function get();

    /**
     * Add a group to the query
     *
     * @param $columns
     * @return mixed
     */
    public function groupBy($columns);

    /**
     * Add a limit to the query
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit);

    /**
     * Add an orderBy to the query
     *
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * Select given columns
     *
     * @param array $columns
     * @return mixed
     */
    public function select($columns = ['*']);

    /**
     * Add where clause to the query
     *
     * @param $column
     * @param null $operator
     * @param $value
     * @param string $boolean
     * @return mixed
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and');

    /**
     * Create multiple models from array
     *
     * @param array $data
     * @return mixed
     */
    public function createMultiple(array $data);

    /**
     * Creates pagination
     *
     * @param int $amount
     * @return mixed
     */
    public function paginate ($amount = 15);

    /**
     * Load relations with model
     *
     * @param $relations
     * @return mixed
     */
    public function with($relations);





}