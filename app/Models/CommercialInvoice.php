<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class CommercialInvoice extends MillModel
{
    use HasFactory;

    protected $table = 'commercial_invoices';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'sales_order_id',
        'dispatch_advice_id',
        'buyer_id',
        'currency_id',
        'invoice_date',
        'amount',
        'vat',
        'total',
        'mushak_form',
        'is_export',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'invoice_date' => 'date',
            'amount' => 'decimal:2',
            'vat' => 'decimal:2',
            'total' => 'decimal:2',
            'is_export' => 'boolean',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SalesOrder::class, 'sales_order_id');
    }

    public function dispatchAdvice(): BelongsTo
    {
        return $this->belongsTo(\App\Models\DispatchAdvice::class, 'dispatch_advice_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'buyer_id');
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
