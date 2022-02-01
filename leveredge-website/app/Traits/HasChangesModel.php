<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait HasChangesModel
{
    protected function hasChanges(Model $model)
    {
        if (!$model->wasChanged()) {
            return false;
        }

        $changes = Arr::except($model->getChanges(), ['updated_at']);

        return count($changes);
    }
}
