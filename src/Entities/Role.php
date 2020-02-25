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
        return $this->belongsTo(config('Smoothsystem.models.role'))->with('parent');
    }

    public function children() {
        return $this->hasMany(config('Smoothsystem.models.role'),'parent_id')->with('children');
    }

    public function roleUsers() {
        return $this->hasMany(config('Smoothsystem.models.role_user'));
    }

    public function gateSettings() {
        return $this->hasMany(config('Smoothsystem.models.gate_setting'));
    }

    public function users() {
        return $this->belongsToMany(config('Smoothsystem.models.user'), 'role_users');
    }

}
