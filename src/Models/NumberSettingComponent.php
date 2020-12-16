<?php

namespace tanyudii\Hero\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Models\BaseModel;

class NumberSettingComponent extends BaseModel
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
