<?php

namespace tanyudii\Hero\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use tanyudii\Hero\Utilities\Models\BaseModel;

class MediaUse extends BaseModel
{
    protected $fillable = [
        'media_id',
        'model',
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
        return $this->morphTo(__FUNCTION__, 'model', 'subject_id');
    }

}
