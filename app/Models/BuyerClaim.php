<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BuyerClaim extends MillModel
{
    use HasFactory;

    protected $table = 'buyer_claims';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'buyer_id',
        'fabric_roll_id',
        'reason',
        'claimed_m',
        'amount',
        'root_cause',
        'issue_id',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'claimed_m' => 'decimal:3',
            'amount' => 'decimal:2',
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

    public function fabricRoll(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricRoll::class, 'fabric_roll_id');
    }

    public function issue(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Issue::class, 'issue_id');
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
