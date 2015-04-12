<?php namespace App\Inspirer\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = ['name', 'display_name', 'description'];

	public function articles()
    {
        return $this->belongsToMany('App\Inspirer\Models\Article');
    }

}
