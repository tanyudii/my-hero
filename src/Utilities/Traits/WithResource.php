<?php

namespace tanyudii\Hero\Utilities\Traits;

use tanyudii\Hero\Http\Resources\BaseResource;

trait WithResource
{
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