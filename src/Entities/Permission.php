<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class Permission extends BaseEntity
{
    protected $fillable = [
        'name',
        'controller',
        'method',
    ];

}
