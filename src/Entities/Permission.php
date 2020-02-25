<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\BaseEntity;

class Permission extends BaseEntity
{
    protected $fillable = [
        'name',
        'controller',
        'method',
    ];

    public function gateSettingPermissions() {
        return $this->hasMany(config('Smoothsystem.models.gate_permission_setting'));
    }

    public function gateSetting() {
        return $this->belongsToMany(config('Smoothsystem.models.gate_setting'), 'gate_setting_permissions');
    }

}
