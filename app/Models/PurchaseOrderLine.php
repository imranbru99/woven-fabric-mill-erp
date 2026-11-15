<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PurchaseOrderLine extends MillModel
{
    use HasFactory;

    protected $table = 'purchase_order_lines';

    protected $fillable = [
        'purchase_order_id',
        'item_type',
        'item_id',
        'yarn_id',
        'description',
        'quantity',
        'received_qty',
        'uom',
        'rate',
        'amount',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'received_qty' => 'decimal:3',
            'rate' => 'decimal:4',
            'amount' => 'decimal:2',
        ];
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PurchaseOrder::class, 'purchase_order_id');
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
