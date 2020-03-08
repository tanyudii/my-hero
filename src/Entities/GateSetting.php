<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class GateSetting extends BaseEntity
{
    protected $fillable = [
        'role_id',
        'user_id',
        'valid_from',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            if (!$data->valid_from) {
                $data->valid_from = now();
            }
        });
    }

    public function role() {
        return $this->belongsTo(config('smoothsystem.entities.role'));
    }

    public function user() {
        return $this->belongsTo(config('smoothsystem.entities.user'));
    }

    public function gateSettingPermissions() {
        return $this->hasMany(config('smoothsystem.models.gate_permission_setting'));
    }

    public function permissions() {
        return $this->belongsToMany(config('smoothsystem.models.permission'), 'gate_setting_permissions')->withTimestamps();
    }

}
