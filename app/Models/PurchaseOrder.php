<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PurchaseOrder extends MillModel
{
    use HasFactory;

    protected $table = 'purchase_orders';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'supplier_id',
        'purchase_requisition_id',
        'currency_id',
        'payment_term_id',
        'incoterm_id',
        'lc_id',
        'is_import',
        'order_date',
        'delivery_date',
        'total',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'is_import' => 'boolean',
            'order_date' => 'date',
            'delivery_date' => 'date',
            'total' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'supplier_id');
    }

    public function purchaseRequisition(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PurchaseRequisition::class, 'purchase_requisition_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Currency::class, 'currency_id');
    }

    public function paymentTerm(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PaymentTerm::class, 'payment_term_id');
    }

    public function incoterm(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Incoterm::class, 'incoterm_id');
    }

    public function lc(): BelongsTo
    {
        return $this->belongsTo(\App\Models\LetterOfCredit::class, 'lc_id');
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
