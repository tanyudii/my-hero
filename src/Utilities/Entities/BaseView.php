<?php

namespace tanyudii\Hero\Utilities\Entities;

use Illuminate\Database\Eloquent\Model;
use tanyudii\Hero\Http\Resources\BaseResource;
use tanyudii\Hero\Utilities\Traits\WithSearchable;
use tanyudii\Hero\Utilities\Traits\WithScope;

abstract class BaseView extends Model
{
    use WithSearchable, WithScope;

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
