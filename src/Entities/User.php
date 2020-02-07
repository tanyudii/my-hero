<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(roleClass());
    }

    public function roleUser() {
        return $this->hasMany(roleUserClass());
    }

    public function getRoleUser() {
        return $this->roleUser()->orderByDesc('valid_from')->first();
    }

    public function getRole() {
        $roleUser = $this->roleUser();

        return $roleUser ? $roleUser->role : null;
    }
}