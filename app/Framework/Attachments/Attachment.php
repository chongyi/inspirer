<?php

namespace Inspirer\Framework\Attachments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Inspirer\Framework\Account\User\User;

class Attachment extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
