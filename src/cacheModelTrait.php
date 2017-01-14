<?php
/**
 * Created by PhpStorm.
 * User: KyleN
 * Date: 14/01/2017
 * Time: 20:34
 */

namespace knash94\repositories;


use Illuminate\Support\Facades\Cache;

trait cacheModelTrait
{
    public function save(array $options = []){
        Cache::tags(get_class($this))->flush();
        return parent::save($options);
    }

    public function delete(array $options = []){
        Cache::tags(get_class($this))->flush();
        return parent::delete($options);
    }

    public function restore(){
        Cache::tags(get_class($this))->flush();
        return parent::restore();
    }
}