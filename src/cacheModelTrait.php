<?php
/**
 * Created by PhpStorm.
 * User: KyleN
 * Date: 14/01/2017
 * Time: 20:34
 */

namespace Knash94\Repositories;


use Illuminate\Support\Facades\Cache;

trait CacheModelTrait
{
    /**
     * Flush cache when the model saves
     *
     * @param array $options
     * @return mixed
     */
    public function save(array $options = []){
        Cache::tags(get_class($this))->flush();
        return parent::save($options);
    }

    /**
     * Flush cache once model is deleted
     *
     * @param array $options
     * @return mixed
     */
    public function delete(array $options = []){
        Cache::tags(get_class($this))->flush();
        return parent::delete($options);
    }

    /**
     * Flush cache once model is restored
     *
     * @return mixed
     */
    public function restore(){
        Cache::tags(get_class($this))->flush();
        return parent::restore();
    }
}