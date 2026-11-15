<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Budget extends MillModel
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'name',
        'fiscal_year_id',
        'cost_centre_id',
        'amount',
        'status',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FiscalYear::class, 'fiscal_year_id');
    }

    public function costCentre(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CostCentre::class, 'cost_centre_id');
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
