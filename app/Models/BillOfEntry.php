<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BillOfEntry extends MillModel
{
    use HasFactory;

    protected $table = 'bills_of_entry';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'shipment_id',
        'be_number',
        'be_date',
        'assessable_value',
        'duty',
        'vat',
        'other_charges',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'be_date' => 'date',
            'assessable_value' => 'decimal:2',
            'duty' => 'decimal:2',
            'vat' => 'decimal:2',
            'other_charges' => 'decimal:2',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Shipment::class, 'shipment_id');
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
