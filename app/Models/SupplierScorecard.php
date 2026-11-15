<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SupplierScorecard extends MillModel
{
    use HasFactory;

    protected $table = 'supplier_scorecards';

    protected $fillable = [
        'supplier_id',
        'period_start',
        'period_end',
        'quality_score',
        'delivery_score',
        'price_score',
        'claim_score',
        'total_score',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'period_start' => 'date',
            'period_end' => 'date',
            'quality_score' => 'decimal:2',
            'delivery_score' => 'decimal:2',
            'price_score' => 'decimal:2',
            'claim_score' => 'decimal:2',
            'total_score' => 'decimal:2',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'supplier_id');
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
