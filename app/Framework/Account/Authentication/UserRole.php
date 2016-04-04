<?php

namespace Inspirer\Framework\Account\Authentication;

use Illuminate\Database\Eloquent\Model;
use Inspirer\Framework\Account\User\User;

/**
 * Class UserRole
 *
 * @package Inspirer\Framework\Account\Authentication
 */
class UserRole extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(UserPermission::class, 'user_permission_user_role', 'permission_id', 'role_id');
    }
}
