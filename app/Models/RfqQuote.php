<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class RfqQuote extends MillModel
{
    use HasFactory;

    protected $table = 'rfq_quotes';

    protected $fillable = [
        'rfq_id',
        'supplier_id',
        'rate',
        'delivery_days',
        'quality_score',
        'rank',
        'is_selected',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'rate' => 'decimal:4',
            'quality_score' => 'decimal:2',
            'is_selected' => 'boolean',
        ];
    }

    public function rfq(): BelongsTo
    {
        return $this->belongsTo(\App\Models\RequestForQuotation::class, 'rfq_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'supplier_id');
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
