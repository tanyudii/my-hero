<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class GateSettingPermission extends BaseEntity
{
    protected $fillable = [
        'gate_setting_id',
        'permission_id',
    ];

    /**
     * @return BelongsTo
     */
    public function gateSetting() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.gate_setting'));
    }

    /**
     * @return BelongsTo
     */
    public function permission() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.permission'));
    }

}
