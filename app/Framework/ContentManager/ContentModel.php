<?php
/**
 * Model.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/4 13:32
 */

namespace Inspirer\Framework\ContentManager;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class ContentModel extends Model
{
    use SoftDeletes;
    
    public function meta()
    {
        return $this->morphOne(Content::class, 'model');
    }

    public function category()
    {
        return $this->meta->category();
    }
}