<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Machine extends MillModel
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = [
        'code',
        'name',
        'machine_type',
        'make',
        'model_name',
        'shed_mechanism',
        'rpm',
        'reed_width_cm',
        'selectors',
        'year_installed',
        'motor_kw',
        'location',
        'unit_id',
        'section_id',
        'status',
        'is_public',
        'running_hours',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'reed_width_cm' => 'decimal:2',
            'motor_kw' => 'decimal:2',
            'is_public' => 'boolean',
        ];
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Unit::class, 'unit_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Section::class, 'section_id');
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
