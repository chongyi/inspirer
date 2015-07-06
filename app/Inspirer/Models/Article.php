<?php namespace App\Inspirer\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = ['title', 'category_id', 'keywords', 'content', 'description', 'name', 'display'];

    public function category()
    {
        return $this->belongsTo('App\Inspirer\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Inspirer\Models\Tag');
    }

    public function next()
    {
        return $this->where('category_id', '<>', 0)->where('id', '>', $this->id)->first();
    }

    public function prev()
    {
        return $this->where('category_id', '<>', 0)->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

}
