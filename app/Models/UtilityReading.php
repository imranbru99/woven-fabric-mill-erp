<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class UtilityReading extends MillModel
{
    use HasFactory;

    protected $table = 'utility_readings';

    protected $fillable = [
        'reading_date',
        'utility',
        'section_id',
        'reading_value',
        'uom',
        'cost',
        'metres_produced',
        'cost_per_metre',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'reading_date' => 'date',
            'reading_value' => 'decimal:3',
            'cost' => 'decimal:2',
            'metres_produced' => 'decimal:3',
            'cost_per_metre' => 'decimal:4',
        ];
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
