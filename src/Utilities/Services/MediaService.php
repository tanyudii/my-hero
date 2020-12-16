<?php

namespace tanyudii\Hero\Utilities\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MediaService
{
    /**
     * File log usages
     *
     * @param Model $model
     * @param string $relationName
     * @return void
     * @throws Exception
     */
    public function logUse(Model $model, string $relationName) : void
    {
        try {
            if ($attachment = $model->$relationName) {
                $logUse = [
                    'model' => get_class($model),
                    'subject_id' => $model->id
                ];

                if (!$attachment->mediaUses()->where($logUse)->exists()) {
                    $attachment->mediaUses()->create($logUse);
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
