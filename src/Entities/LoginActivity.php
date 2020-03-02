<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class LoginActivity extends BaseEntity
{
    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
    ];

    public function user() {
        return $this->belongsTo(config('smoothsystem.models.user'));
    }

}
