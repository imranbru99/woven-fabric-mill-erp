<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JobCard extends MillModel
{
    use HasFactory;

    protected $table = 'job_cards';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'production_plan_id',
        'sales_order_line_id',
        'article_id',
        'stage',
        'qty_m',
        'barcode',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'qty_m' => 'decimal:3',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function productionPlan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ProductionPlan::class, 'production_plan_id');
    }

    public function salesOrderLine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SalesOrderLine::class, 'sales_order_line_id');
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
