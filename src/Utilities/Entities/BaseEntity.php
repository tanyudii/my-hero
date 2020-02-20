<?php

namespace Smoothsystem\Core\Utilities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Smoothsystem\Core\Rules\NotPresent;
use Smoothsystem\Core\Utilities\Traits\UserStamp;

abstract class BaseEntity extends Model
{
    use SoftDeletes, UserStamp;

    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return new HasManySyncable(
            $instance->newQuery(), $this, $instance->getTable().'.'.$foreignKey, $localKey
        );
    }

    public function getDefaultRules() {
        $rules = [];

        foreach ($this->getFillable() as $field) {
            $rules[$field] = [ new NotPresent() ];
        }

        return $rules;
    }

    public function getLabel() {
        return $this->name;
    }

}
