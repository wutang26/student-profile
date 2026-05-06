<?php

namespace App\Traits;

use App\Models\AuditLog;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::logAction('created', $model);
        });

        static::updated(function ($model) {
            self::logAction('updated', $model);
        });

        static::deleted(function ($model) {
            self::logAction('deleted', $model);
        });
    }

    protected static function logAction($action, $model)
    {
        AuditLog::create([
            'performed_by' => auth()->id(),
            'action' => $action,
            'target_type' => class_basename($model),
            'target_id' => $model->id,
            'description' => ucfirst($action) . ' ' . class_basename($model),
        ]);
    }
}