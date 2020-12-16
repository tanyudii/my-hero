<?php

namespace tanyudii\Hero\Models;

use tanyudii\Hero\Utilities\Models\BaseModel;

class Setting extends BaseModel
{
    protected $fillable = [
        'type',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'object',
    ];

}
