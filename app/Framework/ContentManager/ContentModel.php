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

/**
 * Class ContentModel
 *
 * @package Inspirer\Framework\ContentManager
 */
abstract class ContentModel extends Model
{
    /**
     * @var array
     */
    protected $touches = ['meta'];

    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function meta()
    {
        return $this->morphOne(Content::class, 'model');
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->meta->category();
    }
}