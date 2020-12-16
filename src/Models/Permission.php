<?php

namespace tanyudii\Hero\Models;

use tanyudii\Hero\Utilities\Models\BaseModel;

class Permission extends BaseModel
{
    protected $fillable = [
        'name',
        'controller',
        'method',
    ];

}
