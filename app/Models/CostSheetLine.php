<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class CostSheetLine extends MillModel
{
    use HasFactory;

    protected $table = 'cost_sheet_lines';

    protected $fillable = [
        'cost_sheet_id',
        'component',
        'rate',
        'quantity',
        'amount',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'rate' => 'decimal:4',
            'quantity' => 'decimal:3',
            'amount' => 'decimal:2',
        ];
    }

    public function costSheet(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CostSheet::class, 'cost_sheet_id');
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
