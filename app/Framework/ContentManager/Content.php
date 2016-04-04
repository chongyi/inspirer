<?php

namespace Inspirer\Framework\ContentManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Closure;

/**
 * Class Content
 *
 * @package Inspirer\Framework\ContentManager
 */
class Content extends Model
{
    use SoftDeletes;
    
    /**
     * @param mixed $category
     *
     * @return Content
     */
    public function setCategory($category)
    {
        $this->category()->associate($category);

        return $this;
    }

    /**
     * @param mixed $publisher
     *
     * @return Content
     */
    public function setPublisher($publisher)
    {
        $this->account()->associate($publisher);

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return Content
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $title
     *
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $keywords
     *
     * @return Content
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @param mixed $description
     *
     * @return Content
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $model
     * @param Closure|null $callback
     *
     * @return Content
     */
    public function setModel($model, Closure $callback = null)
    {
        if (!is_null($callback)) {
            $manager = ModelManager::getInstance();

            if (is_string($model) && $manager->hasModel($model)) {
                $model = $manager->getModel($model);
                call_user_func($callback, $model, $this);
                $model->save();
            }
        }

        $this->model()->associate($model);

        return $this;
    }

    /**
     * @param mixed $status
     *
     * @return Content
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param mixed $display
     *
     * @return Content
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function account()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
