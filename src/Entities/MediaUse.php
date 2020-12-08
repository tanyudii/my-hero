<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class MediaUse extends BaseEntity
{
    protected $fillable = [
        'media_id',
        'entity',
        'subject_id',
    ];

    /**
     * @return BelongsTo
     */
    public function media() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.media'));
    }

    /**
     * @return MorphTo
     */
    public function subject() : MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'entity', 'subject_id');
    }

}
