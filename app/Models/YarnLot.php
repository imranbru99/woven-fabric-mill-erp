<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class YarnLot extends MillModel
{
    use HasFactory;

    protected $table = 'yarn_lots';

    protected $fillable = [
        'yarn_id',
        'supplier_id',
        'lot_no',
        'qty_kg',
        'unit_cost',
        'status',
        'received_on',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'qty_kg' => 'decimal:3',
            'unit_cost' => 'decimal:4',
            'received_on' => 'date',
        ];
    }

    public function yarn(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Yarn::class, 'yarn_id');
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
