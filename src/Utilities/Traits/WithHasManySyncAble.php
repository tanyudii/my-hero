<?php

namespace tanyudii\Hero\Utilities\Traits;

use tanyudii\Hero\Utilities\Entities\HasManySyncAble;

trait WithHasManySyncAble
{
    public function hasMany($related, $foreignKey = null, $localKey = null) : HasManySyncable
    {
        $instance = $this->newRelatedInstance($related);
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey = $localKey ?: $this->getKeyName();

        return new HasManySyncAble(
            $instance->newQuery(), $this, $instance->getTable().'.'.$foreignKey, $localKey
        );
    }
}