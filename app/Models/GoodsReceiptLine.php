<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class GoodsReceiptLine extends MillModel
{
    use HasFactory;

    protected $table = 'goods_receipt_lines';

    protected $fillable = [
        'goods_receipt_id',
        'purchase_order_line_id',
        'item_type',
        'item_id',
        'lot_no',
        'quantity',
        'accepted_qty',
        'rejected_qty',
        'uom',
        'unit_cost',
        'qc_status',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'accepted_qty' => 'decimal:3',
            'rejected_qty' => 'decimal:3',
            'unit_cost' => 'decimal:4',
        ];
    }

    public function goodsReceipt(): BelongsTo
    {
        return $this->belongsTo(\App\Models\GoodsReceipt::class, 'goods_receipt_id');
    }

    public function purchaseOrderLine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PurchaseOrderLine::class, 'purchase_order_line_id');
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
