<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class StockTransferLine extends MillModel
{
    use HasFactory;

    protected $table = 'stock_transfer_lines';

    protected $fillable = [
        'stock_transfer_id',
        'stock_lot_id',
        'quantity',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
        ];
    }

    public function stockTransfer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\StockTransfer::class, 'stock_transfer_id');
    }

    public function stockLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\StockLot::class, 'stock_lot_id');
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
