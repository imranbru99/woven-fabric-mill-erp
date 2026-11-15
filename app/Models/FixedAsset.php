<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class FixedAsset extends MillModel
{
    use HasFactory;

    protected $table = 'fixed_assets';

    protected $fillable = [
        'code',
        'name',
        'asset_id',
        'acquired_on',
        'cost',
        'accumulated_depreciation',
        'method',
        'rate_pct',
        'useful_life_months',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'acquired_on' => 'date',
            'cost' => 'decimal:2',
            'accumulated_depreciation' => 'decimal:2',
            'rate_pct' => 'decimal:2',
        ];
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Asset::class, 'asset_id');
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
