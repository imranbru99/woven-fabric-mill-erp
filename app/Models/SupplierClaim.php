<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SupplierClaim extends MillModel
{
    use HasFactory;

    protected $table = 'supplier_claims';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'supplier_id',
        'yarn_lot_id',
        'reason',
        'claimed_qty',
        'amount',
        'recovered',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'claimed_qty' => 'decimal:3',
            'amount' => 'decimal:2',
            'recovered' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'supplier_id');
    }

    public function yarnLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'yarn_lot_id');
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
