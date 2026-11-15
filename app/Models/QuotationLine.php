<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class QuotationLine extends MillModel
{
    use HasFactory;

    protected $table = 'quotation_lines';

    protected $fillable = [
        'quotation_id',
        'article_id',
        'shade',
        'quantity',
        'uom',
        'rate',
        'amount',
        'delivery_date',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'rate' => 'decimal:4',
            'amount' => 'decimal:2',
            'delivery_date' => 'date',
        ];
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Quotation::class, 'quotation_id');
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
