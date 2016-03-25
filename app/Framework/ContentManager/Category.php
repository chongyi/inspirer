<?php

namespace Inspirer\Framework\ContentManager;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * @param mixed $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $keyword
     *
     * @return Category
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @param mixed $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return Category
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param boolean $display
     *
     * @return Category
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    public function setParent($category)
    {
        $this->parent()->associate($category);

        return $this;
    }


}
