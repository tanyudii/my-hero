<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class NumberSettingComponent extends BaseEntity
{
    protected $fillable = [
        'number_setting_id',
        'sequence',
        'type',
        'format',
    ];

    public function numberSetting() {
        return $this->belongsTo(NumberSetting::class);
    }

}
