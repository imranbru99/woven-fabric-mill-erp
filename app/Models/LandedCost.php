<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LandedCost extends MillModel
{
    use HasFactory;

    protected $table = 'landed_costs';

    protected $fillable = [
        'bill_of_entry_id',
        'purchase_order_id',
        'yarn_lot_id',
        'invoice_amount',
        'freight',
        'insurance',
        'duty',
        'port_charges',
        'cf_charges',
        'quantity',
        'unit_cost',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'invoice_amount' => 'decimal:2',
            'freight' => 'decimal:2',
            'insurance' => 'decimal:2',
            'duty' => 'decimal:2',
            'port_charges' => 'decimal:2',
            'cf_charges' => 'decimal:2',
            'quantity' => 'decimal:3',
            'unit_cost' => 'decimal:4',
        ];
    }

    public function billOfEntry(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BillOfEntry::class, 'bill_of_entry_id');
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PurchaseOrder::class, 'purchase_order_id');
    }

    public function yarnLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'yarn_lot_id');
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
