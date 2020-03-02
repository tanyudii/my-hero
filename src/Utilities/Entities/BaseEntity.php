<?php

namespace Smoothsystem\Manager\Utilities\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Smoothsystem\Manager\Rules\NotPresent;
use Smoothsystem\Manager\Utilities\Traits\Searchable;
use Smoothsystem\Manager\Utilities\Traits\UserStamp;

abstract class BaseEntity extends Model
{
    use SoftDeletes, UserStamp, Searchable;

    /**
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     ** @var array
     */
    protected $searchable = [
        'columns' => [],
        'joins' => [],
    ];

    public function scopeCriteria($query, Request $request) {
        if ($request->has('order_by') && Schema::hasColumn($this->getTable(), $request->get('order_by'))) {
            $sorted = $request->get('sorted_by') == 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->get('order_by'), $sorted);
        }
    }

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

    // todo: can update by relation
    public function getCanUpdateAttribute() {
        return true;
    }

    // todo: create validation can delete by relation
    public function getCanDeleteAttribute() {
        return true;
    }

}
