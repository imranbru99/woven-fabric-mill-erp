<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class WorkOrder extends MillModel
{
    use HasFactory;

    protected $table = 'work_orders';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'asset_id',
        'machine_id',
        'loom_id',
        'work_type',
        'mechanic_id',
        'started_at',
        'ended_at',
        'downtime_minutes',
        'root_cause',
        'cost',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'cost' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Asset::class, 'asset_id');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
    }

    public function loom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'loom_id');
    }

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'mechanic_id');
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
