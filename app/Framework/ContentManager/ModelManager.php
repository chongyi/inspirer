<?php
/**
 * ModelManager.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/4 13:29
 */

namespace Inspirer\Framework\ContentManager;


/**
 * Class ModelManager
 *
 * @package Inspirer\Framework\ContentManager
 */
class ModelManager
{
    /**
     * @var
     */
    protected static $instance;

    /**
     * @var
     */
    protected $models;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            return static::$instance = new static;
        }
        
        return static::$instance;
    }

    /**
     * @param $name
     * @param $model
     */
    public function register($name, $model)
    {
        if ($model instanceof ContentModel) {
            $this->models[$name] = get_class($model);
        } else {
            $this->models[$name] = $model;
        }
    }

    /**
     * @param $name
     *
     * @return null
     */
    public function getModel($name)
    {
        if (isset($this->models[$name])) {
            $model = $this->models[$name];
            
            if ($model instanceof \Closure) {
                return call_user_func($model);
            }
            
            return new $model;
        }

        return null;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasModel($name)
    {
        return isset($this->models[$name]);
    }
}