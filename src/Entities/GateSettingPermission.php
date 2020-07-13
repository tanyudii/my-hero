<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class GateSettingPermission extends BaseEntity
{
    protected $fillable = [
        'gate_setting_id',
        'permission_id',
    ];

    public function gateSetting()
    {
        return $this->belongsTo(config('smoothsystem.models.gate_setting'));
    }

    public function permission()
    {
        return $this->belongsTo(config('smoothsystem.models.permission'));
    }

}
