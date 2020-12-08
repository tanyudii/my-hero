<?php

namespace tanyudii\Hero\Utilities\Traits;

trait WithAbility
{
    public function getCanUpdateAttribute() : bool
    {
        return true;
    }

    public function getCanDeleteAttribute() : bool
    {
        return true;
    }
}