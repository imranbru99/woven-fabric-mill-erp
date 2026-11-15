<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JournalLine extends MillModel
{
    use HasFactory;

    protected $table = 'journal_lines';

    protected $fillable = [
        'journal_id',
        'account_id',
        'cost_centre_id',
        'debit',
        'credit',
        'narration',
        'currency_code',
        'fx_rate',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'debit' => 'decimal:2',
            'credit' => 'decimal:2',
            'fx_rate' => 'decimal:6',
        ];
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Journal::class, 'journal_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }

    public function costCentre(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CostCentre::class, 'cost_centre_id');
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
