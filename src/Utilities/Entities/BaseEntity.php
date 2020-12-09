<?php

namespace tanyudii\Hero\Utilities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AudibleTrait;
use OwenIt\Auditing\Contracts\Auditable;
use tanyudii\Hero\Utilities\Traits\WithAbility;
use tanyudii\Hero\Utilities\Traits\WithHasManySyncAble;
use tanyudii\Hero\Utilities\Traits\WithModelValidation;
use tanyudii\Hero\Utilities\Traits\WithResource;
use tanyudii\Hero\Utilities\Traits\WithScope;
use tanyudii\Hero\Utilities\Traits\WithSearchable;
use Wildside\Userstamps\Userstamps;

abstract class BaseEntity extends Model implements Auditable
{
    use SoftDeletes,
        Userstamps,
        AudibleTrait,
        WithAbility,
        WithHasManySyncAble,
        WithModelValidation,
        WithResource,
        WithScope,
        WithSearchable;

}
