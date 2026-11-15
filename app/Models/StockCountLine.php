<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class StockCountLine extends MillModel
{
    use HasFactory;

    protected $table = 'stock_count_lines';

    protected $fillable = [
        'stock_count_id',
        'stock_lot_id',
        'book_qty',
        'physical_qty',
        'variance_qty',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'book_qty' => 'decimal:3',
            'physical_qty' => 'decimal:3',
            'variance_qty' => 'decimal:3',
        ];
    }

    public function stockCount(): BelongsTo
    {
        return $this->belongsTo(\App\Models\StockCount::class, 'stock_count_id');
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
