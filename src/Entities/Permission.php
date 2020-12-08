<?php

namespace tanyudii\Hero\Entities;

use tanyudii\Hero\Utilities\Entities\BaseEntity;

class Permission extends BaseEntity
{
    protected $fillable = [
        'name',
        'controller',
        'method',
    ];

}
