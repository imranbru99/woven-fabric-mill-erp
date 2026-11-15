<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class TaxTransaction extends MillModel
{
    use HasFactory;

    protected $table = 'tax_transactions';

    protected $fillable = [
        'tax_rule_id',
        'source_type',
        'source_id',
        'direction',
        'base_amount',
        'tax_amount',
        'tax_date',
        'form_code',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'base_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'tax_date' => 'date',
        ];
    }

    public function taxRule(): BelongsTo
    {
        return $this->belongsTo(\App\Models\TaxRule::class, 'tax_rule_id');
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
