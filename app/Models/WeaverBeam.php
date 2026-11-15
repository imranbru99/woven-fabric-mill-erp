<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class WeaverBeam extends MillModel
{
    use HasFactory;

    protected $table = 'weaver_beams';

    protected $fillable = [
        'number',
        'sizing_batch_id',
        'article_id',
        'length_m',
        'leftover_m',
        'ends',
        'size_addon_pct',
        'gross_kg',
        'net_kg',
        'grade',
        'position',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'length_m' => 'decimal:3',
            'leftover_m' => 'decimal:3',
            'size_addon_pct' => 'decimal:2',
            'gross_kg' => 'decimal:3',
            'net_kg' => 'decimal:3',
        ];
    }

    public function sizingBatch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SizingBatch::class, 'sizing_batch_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
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
