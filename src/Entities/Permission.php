<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class Permission extends BaseEntity
{
    protected $fillable = [
        'name',
        'controller',
        'method',
    ];

    public function gateSettingPermissions() {
        return $this->hasMany(config('smoothsystem.models.gate_permission_setting'));
    }

    public function gateSetting() {
        return $this->belongsToMany(config('smoothsystem.models.gate_setting'), 'gate_setting_permissions')->withTimestamps();
    }

}
