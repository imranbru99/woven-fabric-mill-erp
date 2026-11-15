<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class OrderCost extends MillModel
{
    use HasFactory;

    protected $table = 'order_costs';

    protected $fillable = [
        'sales_order_id',
        'article_id',
        'metres',
        'yarn',
        'sizing',
        'warping',
        'drawing',
        'weaving',
        'finishing',
        'packing',
        'wastage',
        'overhead',
        'total',
        'cost_per_metre',
        'revenue',
        'profit',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'metres' => 'decimal:3',
            'yarn' => 'decimal:2',
            'sizing' => 'decimal:2',
            'warping' => 'decimal:2',
            'drawing' => 'decimal:2',
            'weaving' => 'decimal:2',
            'finishing' => 'decimal:2',
            'packing' => 'decimal:2',
            'wastage' => 'decimal:2',
            'overhead' => 'decimal:2',
            'total' => 'decimal:2',
            'cost_per_metre' => 'decimal:4',
            'revenue' => 'decimal:2',
            'profit' => 'decimal:2',
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
