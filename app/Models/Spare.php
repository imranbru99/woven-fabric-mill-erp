<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Spare extends MillModel
{
    use HasFactory;

    protected $table = 'spares';

    protected $fillable = [
        'code',
        'name',
        'criticality',
        'min_qty',
        'max_qty',
        'lead_time_days',
        'standard_cost',
        'machine_id',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'min_qty' => 'decimal:3',
            'max_qty' => 'decimal:3',
            'standard_cost' => 'decimal:4',
        ];
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
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
