<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class NumberSettingComponent extends BaseEntity
{
    protected $fillable = [
        'number_setting_id',
        'sequence',
        'type',
        'format',
    ];

    /**
     * @return BelongsTo
     */
    public function numberSetting() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.number_setting'));
    }

}
