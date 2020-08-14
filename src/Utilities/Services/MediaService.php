<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Illuminate\Database\Eloquent\Model;

class MediaService
{
    /**
     * File log usages
     *
     * @param Model $model
     * @param string $relationName
     */
    public function logUse(Model $model, string $relationName) {
        if ($attachment = $model->$relationName) {
            $attachment->mediaUses()->create([
                'entity' => get_class($model),
                'subject_id' => $model->id
            ]);
        }
    }
}
