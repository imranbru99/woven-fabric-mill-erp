<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BankLoan extends MillModel
{
    use HasFactory;

    protected $table = 'bank_loans';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'bank_id',
        'loan_type',
        'principal',
        'interest_pct',
        'tenure_months',
        'emi',
        'starts_on',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'principal' => 'decimal:2',
            'interest_pct' => 'decimal:2',
            'emi' => 'decimal:2',
            'starts_on' => 'date',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'bank_id');
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
