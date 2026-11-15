<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PmTask extends MillModel
{
    use HasFactory;

    protected $table = 'pm_tasks';

    protected $fillable = [
        'pm_schedule_id',
        'task',
        'is_done',
        'done_on',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'is_done' => 'boolean',
            'done_on' => 'date',
        ];
    }

    public function pmSchedule(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PmSchedule::class, 'pm_schedule_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Branch::class, 'branch_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}
