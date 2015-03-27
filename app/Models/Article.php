<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable = ['title', 'category_id', 'keywords', 'content', 'description'];

	public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
