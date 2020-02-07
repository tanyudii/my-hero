<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\BaseEntity;

class Role extends BaseEntity
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function users() {
        return $this->belongsToMany(userClass(), 'role_users');
    }

    public function roleUsers() {
        return $this->hasMany(roleClass());
    }
}