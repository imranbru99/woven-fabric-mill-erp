<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PackingListLine extends MillModel
{
    use HasFactory;

    protected $table = 'packing_list_lines';

    protected $fillable = [
        'packing_list_id',
        'fabric_roll_id',
        'carton_no',
        'metres',
        'net_kg',
        'gross_kg',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'metres' => 'decimal:3',
            'net_kg' => 'decimal:3',
            'gross_kg' => 'decimal:3',
        ];
    }

    public function packingList(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PackingList::class, 'packing_list_id');
    }

    public function fabricRoll(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricRoll::class, 'fabric_roll_id');
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
