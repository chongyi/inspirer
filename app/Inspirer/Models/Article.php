<?php namespace App\Inspirer\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable = ['title', 'category_id', 'keywords', 'content', 'description'];

	public function category()
    {
        return $this->belongsTo('App\Inspirer\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Inspirer\Models\Tag');
    }

}