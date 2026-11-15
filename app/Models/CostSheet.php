<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class CostSheet extends MillModel
{
    use HasFactory;

    protected $table = 'cost_sheets';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'article_id',
        'buyer_id',
        'currency_code',
        'yarn_cost_per_m',
        'sizing_cost_per_m',
        'weaving_cost_per_m',
        'process_cost_per_m',
        'overhead_per_m',
        'finance_cost_per_m',
        'commission_per_m',
        'target_margin_pct',
        'quoted_rate',
        'valid_until',
        'sensitivity',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'yarn_cost_per_m' => 'decimal:4',
            'sizing_cost_per_m' => 'decimal:4',
            'weaving_cost_per_m' => 'decimal:4',
            'process_cost_per_m' => 'decimal:4',
            'overhead_per_m' => 'decimal:4',
            'finance_cost_per_m' => 'decimal:4',
            'commission_per_m' => 'decimal:4',
            'target_margin_pct' => 'decimal:2',
            'quoted_rate' => 'decimal:4',
            'valid_until' => 'date',
            'sensitivity' => 'array',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'buyer_id');
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
