<?php

namespace Smoothsystem\Core\Utilities\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\HasApiTokens;
use Smoothsystem\Core\Rules\NotPresent;
use Smoothsystem\Core\Utilities\Traits\Searchable;
use Smoothsystem\Core\Utilities\Traits\UserStamp;

abstract class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserStamp, HasApiTokens, Searchable;
    
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
