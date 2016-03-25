<?php
/**
 * AccountTrait.php
 *
 * Creator:    chongyi
 * Created at: 2016/3/25 0025 18:13
 */

namespace Inspirer\Framework\ContentManager;


trait AccountTrait
{
    public function contents()
    {
        return $this->morphMany(Content::class, 'account');
    }
}