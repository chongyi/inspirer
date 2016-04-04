<?php

namespace Inspirer\Framework\Account\Authentication;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPermission
 *
 * @package Inspirer\Framework\Account\Authentication
 */
class UserPermission extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_permission_user_role', 'permission_id', 'role_id');
    }
}
