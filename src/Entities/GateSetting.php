<?php

namespace Smoothsystem\Core\Entities;

use Smoothsystem\Core\Utilities\Entities\BaseEntity;

class GateSetting extends BaseEntity
{
    protected $fillable = [
        'role_id',
        'user_id',
        'valid_from',
    ];

    public function role() {
        return $this->belongsTo(config('Smoothsystem.entities.role'));
    }

    public function user() {
        return $this->belongsTo(config('Smoothsystem.entities.user'));
    }

    public function gateSettingPermissions() {
        return $this->hasMany(config('Smoothsystem.models.gate_permission_setting'));
    }

    public function permissions() {
        return $this->belongsToMany(config('Smoothsystem.models.permission'), 'gate_setting_permissions');
    }

}
