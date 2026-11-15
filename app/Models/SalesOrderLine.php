<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SalesOrderLine extends MillModel
{
    use HasFactory;

    protected $table = 'sales_order_lines';

    protected $fillable = [
        'sales_order_id',
        'article_id',
        'shade',
        'width_cm',
        'quantity',
        'uom',
        'rate',
        'amount',
        'delivery_date',
        'tolerance_pct',
        'produced_qty',
        'dispatched_qty',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'width_cm' => 'decimal:2',
            'quantity' => 'decimal:3',
            'rate' => 'decimal:4',
            'amount' => 'decimal:2',
            'delivery_date' => 'date',
            'tolerance_pct' => 'decimal:2',
            'produced_qty' => 'decimal:3',
            'dispatched_qty' => 'decimal:3',
        ];
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SalesOrder::class, 'sales_order_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
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
