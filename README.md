# knash94-repositories
Repositories is a package for Laravel that makes it much easier to create repositories for Laravel, whether you want just a Eloquent repository or an eloquent repository with cache.

##Installation
Run the following command from your terminal
```bash
composer require knash94/repositories
```

Open app/config with your favorite text editor and add the following line under package service providers
```php
Knash94\Repositories\RepositoryServiceProvider::class,
```

##usage
To create a basic repository without cache
```bash
php artisan make:repository exampleRepository
```

or with cache
```bash
php artisan make:repository exampleRepository
```

Afterwards, open the new generated file under app/repositories/exampleRepository.php and find 
```php
protected $model;
```

and replace it with your models class, for example
```php
protected $model = User::class;
```

After that you're all ready to go!

##Repository methods
```php
public function all();

public function count();

public function countWhere($column, $value);

public function findById($id);

public function updateById($id, array $attributes);

public function create(array $attributes);

public function get();

public function groupBy($columns);

public function limit($limit);

public function orderBy($column, $direction = 'asc');

public function select($columns = ['*']);

public function where($column, $operator = null, $value = null, $boolean = 'and');

public function createMultiple(array $data);

public function with($relations);
```
