<?php

namespace Smoothsystem\Core\Listeners;

use Illuminate\Database\Eloquent\Model;

class Restoring
{
    /**
     * When the model is being restored.
     *
     * @param Model $model
     * @return void
     */
    public function handle(Model $model)
    {
        if (! $model->isUserstamping()) {
            return;
        }

        $model->{$model->getDeletedByColumn()} = null;
    }
}
