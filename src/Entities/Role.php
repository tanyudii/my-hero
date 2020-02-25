<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\BaseEntity;

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
        return $this->belongsToMany(config('smoothsystem.models.user'), 'role_users');
    }

}
