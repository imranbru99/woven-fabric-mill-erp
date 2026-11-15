<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class StockLot extends MillModel
{
    use HasFactory;

    protected $table = 'stock_lots';

    protected $fillable = [
        'item_type',
        'item_id',
        'lot_no',
        'warehouse_id',
        'supplier_id',
        'yarn_lot_id',
        'qty',
        'reserved_qty',
        'uom',
        'unit_cost',
        'status',
        'expiry_date',
        'hold_reason',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'qty' => 'decimal:3',
            'reserved_qty' => 'decimal:3',
            'unit_cost' => 'decimal:4',
            'expiry_date' => 'date',
        ];
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Warehouse::class, 'warehouse_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'supplier_id');
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
