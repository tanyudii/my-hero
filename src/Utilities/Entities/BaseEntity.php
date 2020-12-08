<?php

namespace tanyudii\Hero\Utilities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AudibleTrait;
use OwenIt\Auditing\Contracts\Auditable;
use tanyudii\Hero\Http\Resources\BaseResource;
use tanyudii\Hero\Utilities\Traits\WithSearchable;
use tanyudii\Hero\Utilities\Traits\WithAbility;
use tanyudii\Hero\Utilities\Traits\WithHasManySyncAble;
use tanyudii\Hero\Utilities\Traits\WithModelValidation;
use tanyudii\Hero\Utilities\Traits\WithScope;
use Wildside\Userstamps\Userstamps;

abstract class BaseEntity extends Model implements Auditable
{
    use SoftDeletes,
        Userstamps,
        AudibleTrait,
        WithAbility,
        WithHasManySyncAble,
        WithModelValidation,
        WithScope,
        WithSearchable;

    protected $indexResource = BaseResource::class;
    protected $showResource = BaseResource::class;
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
