<?php

namespace tanyudii\Hero\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Models\BaseModel;

class GateSettingPermission extends BaseModel
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
