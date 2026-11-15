<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Cheque extends MillModel
{
    use HasFactory;

    protected $table = 'cheques';

    protected $fillable = [
        'cheque_no',
        'bank_account_id',
        'party_id',
        'direction',
        'amount',
        'cheque_date',
        'status',
        'is_pdc',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'cheque_date' => 'date',
            'is_pdc' => 'boolean',
        ];
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BankAccount::class, 'bank_account_id');
    }

    public function party(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'party_id');
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
