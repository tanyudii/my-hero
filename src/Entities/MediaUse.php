<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class MediaUse extends BaseEntity
{
    protected $fillable = [
        'media_id',
        'entity',
        'subject_id',
    ];

    public function media()
    {
        return $this->belongsTo(config('smoothsystem.models.media'));
    }

    public function subject()
    {
        return $this->morphTo(__FUNCTION__, 'entity', 'subject_id');
    }

}
