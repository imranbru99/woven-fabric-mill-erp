<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SizingBatch extends MillModel
{
    use HasFactory;

    protected $table = 'sizing_batches';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'size_recipe_id',
        'machine_id',
        'cooked_at',
        'viscosity',
        'concentration',
        'pickup_target',
        'pickup_actual',
        'moisture',
        'stretch_pct',
        'speed',
        'steam_pressure',
        'chemical_kg',
        'cost',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'cooked_at' => 'datetime',
            'viscosity' => 'decimal:2',
            'concentration' => 'decimal:2',
            'pickup_target' => 'decimal:2',
            'pickup_actual' => 'decimal:2',
            'moisture' => 'decimal:2',
            'stretch_pct' => 'decimal:2',
            'steam_pressure' => 'decimal:2',
            'chemical_kg' => 'decimal:3',
            'cost' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function sizeRecipe(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SizeRecipe::class, 'size_recipe_id');
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
