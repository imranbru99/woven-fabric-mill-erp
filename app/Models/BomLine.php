<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BomLine extends MillModel
{
    use HasFactory;

    protected $table = 'bom_lines';

    protected $fillable = [
        'bom_id',
        'stage',
        'item_type',
        'item_id',
        'qty_per_100m',
        'uom',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'qty_per_100m' => 'decimal:4',
        ];
    }

    public function bom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BillOfMaterial::class, 'bom_id');
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
