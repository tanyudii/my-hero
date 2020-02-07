<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\BaseEntity;

class RoleUser extends BaseEntity
{
    protected $fillable = [
        'role_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(userClass());
    }

    public function role() {
        return $this->belongsTo(roleClass());
    }

}