<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Payment extends MillModel
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'party_id',
        'bank_account_id',
        'amount',
        'currency_code',
        'method',
        'instrument_no',
        'paid_on',
        'journal_id',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'amount' => 'decimal:2',
            'paid_on' => 'date',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function party(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'party_id');
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BankAccount::class, 'bank_account_id');
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Journal::class, 'journal_id');
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
