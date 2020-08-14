<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class MediaService
{
    /**
     * File log usages
     *
     * @param BaseEntity $model
     * @param string $relationName
     */
    public function logUse(BaseEntity $model, string $relationName) {
        if ($attachment = $model->$relationName) {
            $attachment->mediaUses()->create([
                'entity' => get_class($model),
                'subject_id' => $model->id
            ]);
        }
    }
}