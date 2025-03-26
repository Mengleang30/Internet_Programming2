<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ModelActivityObserver
{
    //
    public function created(Model $model)
    {
        ActivityLog::create([
            'model' => get_class($model),
            'model_id' => $model->id,
            'action' => 'created',
            'changes' => json_encode($model->toArray()),
        ]);

    }

    public function updated(Model $model){
        ActivityLog::create([
            'model' => get_class($model),
            'model_id' => $model->id,
            'action' => 'updated',
            'changes' => json_encode([
                'old' => $model->getOriginal(),
                'new' => $model->getChanges(),
            ]),
        ]);
    }


    public function deleted(Model $model){
        ActivityLog::create([
            'model' => get_class($model),
            'model_id' => $model->id,
            'action' => 'deleted',
            'changes' => json_encode($model->toArray()),
        ]);
    }
}
