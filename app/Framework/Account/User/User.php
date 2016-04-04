<?php

namespace Inspirer\Framework\Account\User;

use Illuminate\Foundation\Auth\User as AuthUser;
use Inspirer\Framework\Account\Authentication\UserRole;
use Inspirer\Framework\Attachments\UserAttachmentTrait;
use Inspirer\Framework\ContentManager\AccountTrait;
use Hash;

/**
 * Class User
 *
 * @package Inspirer\Framework\Account\User
 */
class User extends AuthUser
{
    use AccountTrait, UserAttachmentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param mixed $nickname
     *
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_user_role', 'user_id', 'user_role_id');
    }
}
