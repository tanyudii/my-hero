<?php

namespace tanyudii\Hero\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Models\BaseModel;

class LoginActivity extends BaseModel
{
    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.user'));
    }

}
