<?php

namespace tanyudii\Hero\Utilities\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable as AudibleTrait;
use OwenIt\Auditing\Contracts\Auditable;
use tanyudii\Hero\Utilities\Traits\WithAbility;
use tanyudii\Hero\Utilities\Traits\WithHasManySyncAble;
use tanyudii\Hero\Utilities\Traits\WithModelValidation;
use tanyudii\Hero\Utilities\Traits\WithResource;
use tanyudii\Hero\Utilities\Traits\WithScope;
use tanyudii\Hero\Utilities\Traits\WithSearchable;
use tanyudii\Hero\Utilities\Traits\WithUserGateHero;
use Wildside\Userstamps\Userstamps;

abstract class User extends Authenticatable implements Auditable
{
    use SoftDeletes,
        Userstamps,
        AudibleTrait,
        WithAbility,
        WithHasManySyncAble,
        WithModelValidation,
        WithResource,
        WithScope,
        WithSearchable,
        WithUserGateHero;
}
