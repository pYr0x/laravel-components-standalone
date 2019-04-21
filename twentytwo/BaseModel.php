<?php
/**
 * creation date: 31.03.2019
 *
 * @author          Julian Kern
 * @copyright       Copyright (c) 2007-2019 Julian Kern, twentytwo Solutions (http://www.22-solutions.de)
 * All Rights Reserved
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace twentytwo;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerInterface;

/**
 * Class BaseModel
 * @method static Model find($id, $columns = ['*']) Find a model by its primary key.
 * @method EloquentModel|EloquentBuilder|null first($columns = ['*']) Execute the query and get the first result.
 * @method EloquentModel|EloquentBuilder firstOrFail($columns = ['*']) Execute the query and get the first result or throw an exception.
 * @method Collection|EloquentBuilder[] get($columns = ['*']) Execute the query as a "select" statement.
 * @method mixed value($column) Get a single column's value from the first result of a query.
 * @method mixed pluck($column) Get a single column's value from the first result of a query.
 * @method void chunk($count, callable $callback) Chunk the results of the query.
 * @method \Illuminate\Support\Collection lists($column, $key = null) Get an array with the values of a given column.
 * @method LengthAwarePaginator paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) Paginate the given query.
 * @method Paginator simplePaginate($perPage = null, $columns = ['*'], $pageName = 'page') Paginate the given query into a simple paginator.
 * @method int increment($column, $amount = 1, array $extra = []) Increment a column's value by a given amount.
 * @method int decrement($column, $amount = 1, array $extra = []) Decrement a column's value by a given amount.
 * @method void onDelete(Closure $callback) Register a replacement for the default delete function.
 * @method EloquentModel[] getModels($columns = ['*']) Get the hydrated models without eager loading.
 * @method array eagerLoadRelations(array $models) Eager load the relationships for the models.
 * @method array loadRelation(array $models, $name, Closure $constraints) Eagerly load the relationship on a set of models.
 * @method static QueryBuilder where($column, $operator = null, $value = null, $boolean = 'and') Add a basic where clause to the query.
 * @method EloquentBuilder orWhere($column, $operator = null, $value = null) Add an "or where" clause to the query.
 * @method EloquentBuilder has($relation, $operator = '>=', $count = 1, $boolean = 'and', Closure $callback = null) Add a relationship count condition to the query.
 * @method static EloquentBuilder orderBy($column, $direction = 'asc')
 * @method static EloquentBuilder select($columns = ['*'])
 *
 *
 * @method static Builder whereRaw($sql, array $bindings = [])
 * @method static Builder whereBetween($column, array $values)
 * @method static Builder whereNotBetween($column, array $values)
 * @method static Builder whereNested(callable $callback)
 * @method static Builder addNestedWhereQuery($query)
 * @method static Builder whereExists(callable $callback)
 * @method static Builder whereNotExists(callable $callback)
 * @method static Builder whereIn($column, $values)
 * @method static Builder whereNotIn($column, $values)
 * @method static Builder whereNull($column)
 * @method static Builder whereNotNull($column)
 * @method static Builder orWhereRaw($sql, array $bindings = [])
 * @method static Builder orWhereBetween($column, array $values)
 * @method static Builder orWhereNotBetween($column, array $values)
 * @method static Builder orWhereExists(callable $callback)
 * @method static Builder orWhereNotExists(callable $callback)
 * @method static Builder orWhereIn($column, $values)
 * @method static Builder orWhereNotIn($column, $values)
 * @method static Builder orWhereNull($column)
 * @method static Builder orWhereNotNull($column)
 * @method static Builder whereDate($column, $operator, $value)
 * @method static Builder whereDay($column, $operator, $value)
 * @method static Builder whereMonth($column, $operator, $value)
 * @method static Builder whereYear($column, $operator, $value)
 */
class BaseModel extends Model
{

    protected $routerKeyName;

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $foo = (new static);

        return $foo->$method(...$parameters);
    }



    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        if(!$this->routerKeyName){
            $classname = substr(strrchr(__CLASS__, "\\"), 1);
            $this->routerKeyName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $classname));
        }
        return $this->routerKeyName;
    }


    /**
     * getDefinition
     *
     * @return \Closure
     */
    public static function getDefinition() {
        return function (ContainerInterface $c) {

            if(!static::getConnectionResolver()){
                static::setConnectionResolver($c->get('Database'));
            }

            /** @var $this $model */
            $model = (new static);

            if(isset($_GET[$model->getRouteKeyName()])){
                $instance = $model->find($_GET[$model->getRouteKeyName()]);
                if(!is_null($instance)){
                    return $instance;
                }
            }

            return false;
        };
    }

}