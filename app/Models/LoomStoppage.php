<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LoomStoppage extends MillModel
{
    use HasFactory;

    protected $table = 'loom_stoppages';

    protected $fillable = [
        'loom_id',
        'shift_id',
        'operator_id',
        'reason_code',
        'reason_bn',
        'started_at',
        'ended_at',
        'minutes',
        'source',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function loom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'loom_id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Shift::class, 'shift_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'operator_id');
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
