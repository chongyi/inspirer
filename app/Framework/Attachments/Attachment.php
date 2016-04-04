<?php

namespace Inspirer\Framework\Attachments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Inspirer\Framework\Account\User\User;

/**
 * Class Attachment
 *
 * @package Inspirer\Framework\Attachments
 */
class Attachment extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
