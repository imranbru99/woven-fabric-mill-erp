<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PmSchedule extends MillModel
{
    use HasFactory;

    protected $table = 'pm_schedules';

    protected $fillable = [
        'asset_id',
        'machine_id',
        'frequency',
        'every_hours',
        'next_due',
        'is_active',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'next_due' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Asset::class, 'asset_id');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
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
