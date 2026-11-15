<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class StockMove extends MillModel
{
    use HasFactory;

    protected $table = 'stock_moves';

    protected $fillable = [
        'stock_lot_id',
        'warehouse_id',
        'bin_id',
        'qty',
        'uom',
        'unit_cost',
        'move_type',
        'reference_type',
        'reference_id',
        'job_card_id',
        'mix_approved',
        'narration',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'qty' => 'decimal:3',
            'unit_cost' => 'decimal:4',
            'mix_approved' => 'boolean',
        ];
    }

    public function stockLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\StockLot::class, 'stock_lot_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Warehouse::class, 'warehouse_id');
    }

    public function bin(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Bin::class, 'bin_id');
    }

    public function jobCard(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobCard::class, 'job_card_id');
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
