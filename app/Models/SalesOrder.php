<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SalesOrder extends MillModel
{
    use HasFactory;

    protected $table = 'sales_orders';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'buyer_id',
        'quotation_id',
        'sales_contract_id',
        'lc_id',
        'currency_id',
        'order_date',
        'delivery_date',
        'tolerance_pct',
        'total',
        'margin_pct',
        'feasibility',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'order_date' => 'date',
            'delivery_date' => 'date',
            'tolerance_pct' => 'decimal:2',
            'total' => 'decimal:2',
            'margin_pct' => 'decimal:2',
            'feasibility' => 'array',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'buyer_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Quotation::class, 'quotation_id');
    }

    public function salesContract(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SalesContract::class, 'sales_contract_id');
    }

    public function lc(): BelongsTo
    {
        return $this->belongsTo(\App\Models\LetterOfCredit::class, 'lc_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Currency::class, 'currency_id');
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
