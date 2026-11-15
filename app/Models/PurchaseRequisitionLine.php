<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PurchaseRequisitionLine extends MillModel
{
    use HasFactory;

    protected $table = 'purchase_requisition_lines';

    protected $fillable = [
        'purchase_requisition_id',
        'item_type',
        'item_id',
        'description',
        'quantity',
        'uom',
        'estimated_rate',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'estimated_rate' => 'decimal:4',
        ];
    }

    public function purchaseRequisition(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PurchaseRequisition::class, 'purchase_requisition_id');
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
