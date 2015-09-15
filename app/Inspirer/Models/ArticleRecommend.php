<?php
/**
 * ArticleRecommend.php
 *
 * Created by Chongyi
 * Date & Time 2015/9/15 15:56
 */

namespace App\Inspirer\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleRecommend extends Model
{
    public function article()
    {
        return $this->hasOne('App\Inspirer\Models\Article', 'id', 'article_id');
    }
}