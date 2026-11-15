<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SectionBeam extends MillModel
{
    use HasFactory;

    protected $table = 'section_beams';

    protected $fillable = [
        'number',
        'warping_job_id',
        'machine_id',
        'operator_id',
        'ends',
        'length_m',
        'gross_kg',
        'net_kg',
        'status',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'length_m' => 'decimal:3',
            'gross_kg' => 'decimal:3',
            'net_kg' => 'decimal:3',
        ];
    }

    public function warpingJob(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WarpingJob::class, 'warping_job_id');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
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
