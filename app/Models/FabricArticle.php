<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ImranDev\UniversalSlug\Attributes\Slug;
use ImranDev\UniversalSlug\Traits\HasUniversalSlug;
use App\Models\Concerns\MillModel;

#[Slug(from: 'name', to: 'slug', language: 'bn')]

class FabricArticle extends MillModel
{
    use HasFactory, HasUniversalSlug;

    protected $table = 'fabric_articles';

    protected $fillable = [
        'code',
        'name',
        'slug',
        'warp_yarn_id',
        'weft_yarn_id',
        'epi',
        'ppi',
        'weave',
        'grey_width_cm',
        'finished_width_cm',
        'grey_gsm',
        'finished_gsm',
        'warp_shrinkage_pct',
        'weft_shrinkage_pct',
        'composition',
        'finish_type',
        'end_use',
        'reed_count',
        'reed_space_inch',
        'ends_per_dent',
        'selvedge_ends',
        'selvedge_type',
        'crimp_warp_pct',
        'crimp_weft_pct',
        'design_grid',
        'total_ends',
        'warp_kg_per_100m',
        'weft_kg_per_100m',
        'calculated_gsm',
        'expected_efficiency',
        'metres_per_loom_shift',
        'is_public',
        'public_summary',
        'image_path',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'epi' => 'decimal:2',
            'ppi' => 'decimal:2',
            'grey_width_cm' => 'decimal:2',
            'finished_width_cm' => 'decimal:2',
            'grey_gsm' => 'decimal:2',
            'finished_gsm' => 'decimal:2',
            'warp_shrinkage_pct' => 'decimal:2',
            'weft_shrinkage_pct' => 'decimal:2',
            'reed_count' => 'decimal:2',
            'reed_space_inch' => 'decimal:2',
            'crimp_warp_pct' => 'decimal:2',
            'crimp_weft_pct' => 'decimal:2',
            'design_grid' => 'array',
            'warp_kg_per_100m' => 'decimal:4',
            'weft_kg_per_100m' => 'decimal:4',
            'calculated_gsm' => 'decimal:2',
            'expected_efficiency' => 'decimal:2',
            'metres_per_loom_shift' => 'decimal:3',
            'is_public' => 'boolean',
        ];
    }

    public function warpYarn(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Yarn::class, 'warp_yarn_id');
    }

    public function weftYarn(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Yarn::class, 'weft_yarn_id');
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
