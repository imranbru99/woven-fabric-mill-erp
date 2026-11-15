<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

abstract class MillModel extends Model
{
    use LogsActivity;
    use SoftDeletes;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    protected static function booted(): void
    {
        static::creating(function (self $model): void {
            $userId = auth()->id();
            if ($userId && empty($model->created_by)) {
                $model->created_by = $userId;
            }
        });

        static::updating(function (self $model): void {
            $userId = auth()->id();
            if ($userId) {
                $model->updated_by = $userId;
            }
        });
    }
}
