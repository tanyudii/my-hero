<?php

namespace tanyudii\Hero\Entities;

use tanyudii\Hero\Utilities\Entities\BaseEntity;

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
