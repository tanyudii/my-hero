<?php

namespace tanyudii\Hero\Utilities\Models;

use Illuminate\Database\Eloquent\Model;
use tanyudii\Hero\Utilities\Traits\WithResource;
use tanyudii\Hero\Utilities\Traits\WithScope;
use tanyudii\Hero\Utilities\Traits\WithSearchable;

abstract class BaseView extends Model
{
    use WithSearchable, WithResource, WithScope;

}
