<?php

namespace Smoothsystem\Manager\Entities;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class FileLogUse extends BaseEntity
{
    protected $fillable = [
        'file_log_id',
        'entity',
        'subject_id',
    ];

    public function fileLog()
    {
        return $this->belongsTo(config('smoothsystem.models.file_log'));
    }

    public function subject()
    {
        return $this->morphTo(__FUNCTION__, 'entity', 'subject_id');
    }

}
