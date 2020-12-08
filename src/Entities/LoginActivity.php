<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class LoginActivity extends BaseEntity
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
