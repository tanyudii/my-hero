<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class FileLogService
{
    public function logUse(BaseEntity $model, string $relationName) {
        if ($attachment = $model->$relationName) {
            $attachment->fileLogUses()->create([
                'entity' => get_class($model),
                'subject_id' => $model->id
            ]);
        }
    }
}
