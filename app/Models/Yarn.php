<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Yarn extends MillModel
{
    use HasFactory;

    protected $table = 'yarns';

    protected $fillable = [
        'code',
        'name',
        'count_value',
        'count_system',
        'yarn_type',
        'cotton_pct',
        'poly_pct',
        'viscose_pct',
        'twist_direction',
        'ply',
        'origin',
        'mill_brand',
        'colour',
        'cone_weight_kg',
        'is_filament',
        'standard_cost',
        'reorder_kg',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'count_value' => 'decimal:3',
            'cotton_pct' => 'decimal:2',
            'poly_pct' => 'decimal:2',
            'viscose_pct' => 'decimal:2',
            'cone_weight_kg' => 'decimal:3',
            'is_filament' => 'boolean',
            'standard_cost' => 'decimal:4',
            'reorder_kg' => 'decimal:3',
        ];
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
