<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class Setting extends BaseEntity
{
    protected $fillable = [
        'type',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'object',
    ];

}
