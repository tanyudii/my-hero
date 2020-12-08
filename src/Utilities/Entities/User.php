<?php

namespace tanyudii\Hero\Utilities\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable as AudibleTrait;
use OwenIt\Auditing\Contracts\Auditable;
use tanyudii\Hero\Http\Resources\BaseResource;
use tanyudii\Hero\Utilities\Traits\WithAbility;
use tanyudii\Hero\Utilities\Traits\WithHasManySyncAble;
use tanyudii\Hero\Utilities\Traits\WithModelValidation;
use tanyudii\Hero\Utilities\Traits\WithScope;
use tanyudii\Hero\Utilities\Traits\WithSearchable;
use Wildside\Userstamps\Userstamps;

abstract class User extends Authenticatable implements Auditable
{
    use SoftDeletes,
        Userstamps,
        AudibleTrait,
        WithAbility,
        WithHasManySyncAble,
        WithModelValidation,
        WithScope,
        WithSearchable;

    /**
     * @var string
     */
    protected $indexResource = BaseResource::class;

    /**
     * @var string
     */
    protected $showResource = BaseResource::class;

    /**
     * @var string
     */
    protected $selectResource = BaseResource::class;

    /**
     * @return string
     */
    public function getResource() : string
    {
        return $this->indexResource;
    }

    /**
     * @return string
     */
    public function getShowResource() : string
    {
        return $this->showResource;
    }

    /**
     * @return string
     */
    public function getSelectResource() : string
    {
        return $this->selectResource;
    }
}
