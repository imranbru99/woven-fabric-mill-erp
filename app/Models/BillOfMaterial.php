<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BillOfMaterial extends MillModel
{
    use HasFactory;

    protected $table = 'bill_of_materials';

    protected $fillable = [
        'article_id',
        'warp_kg_per_100m',
        'weft_kg_per_100m',
        'size_addon_pct',
        'waste_warping_pct',
        'waste_sizing_pct',
        'waste_drawing_pct',
        'waste_weaving_pct',
        'waste_inspection_pct',
        'is_active',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'warp_kg_per_100m' => 'decimal:4',
            'weft_kg_per_100m' => 'decimal:4',
            'size_addon_pct' => 'decimal:2',
            'waste_warping_pct' => 'decimal:2',
            'waste_sizing_pct' => 'decimal:2',
            'waste_drawing_pct' => 'decimal:2',
            'waste_weaving_pct' => 'decimal:2',
            'waste_inspection_pct' => 'decimal:2',
            'is_active' => 'boolean',
        ];
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
