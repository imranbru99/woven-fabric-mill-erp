<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LetterOfCredit extends MillModel
{
    use HasFactory;

    protected $table = 'letters_of_credit';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'lc_type',
        'buyer_id',
        'bank_id',
        'sales_contract_id',
        'lc_number',
        'amount',
        'utilised',
        'currency_code',
        'expiry_date',
        'shipment_date',
        'btb_limit_pct',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'amount' => 'decimal:2',
            'utilised' => 'decimal:2',
            'expiry_date' => 'date',
            'shipment_date' => 'date',
            'btb_limit_pct' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'buyer_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'bank_id');
    }

    public function salesContract(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SalesContract::class, 'sales_contract_id');
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
