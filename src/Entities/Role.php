<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class Role extends BaseEntity
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'parent_id',
        'is_special',
    ];

    public function parent() {
        return $this->belongsTo(config('smoothsystem.models.role'))->with('parent');
    }

    public function children() {
        return $this->hasMany(config('smoothsystem.models.role'),'parent_id')->with('children');
    }

    public function roleUsers() {
        return $this->hasMany(config('smoothsystem.models.role_user'));
    }

    public function gateSettings() {
        return $this->hasMany(config('smoothsystem.models.gate_setting'));
    }

    public function users() {
        return $this->belongsToMany(config('smoothsystem.models.user'), 'role_users')->withTimestamps();
    }

    public function getChildrenIdsAttribute() {
        $data = [];

        $this->recursiveChildrenGetAttribute($this, $data);

        return $data;
    }

    public function recursiveChildrenGetAttribute($child, &$data, $key = 'id') {
        array_push($data, $child[$key]);

        if (count($child->children) > 0) {
            foreach ($child->children as $child) {
                $this->recursiveChildrenGetAttribute($child, $data, $key);
            }
        }
    }

}
