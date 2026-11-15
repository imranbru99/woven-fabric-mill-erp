<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class YarnRequirement extends MillModel
{
    use HasFactory;

    protected $table = 'yarn_requirements';

    protected $fillable = [
        'production_plan_id',
        'yarn_id',
        'direction',
        'required_kg',
        'available_kg',
        'shortage_kg',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'required_kg' => 'decimal:3',
            'available_kg' => 'decimal:3',
            'shortage_kg' => 'decimal:3',
        ];
    }

    public function productionPlan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ProductionPlan::class, 'production_plan_id');
    }

    public function yarn(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Yarn::class, 'yarn_id');
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
