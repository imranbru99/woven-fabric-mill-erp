<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class BeamPlan extends MillModel
{
    use HasFactory;

    protected $table = 'beam_plans';

    protected $fillable = [
        'production_plan_id',
        'article_id',
        'warp_length_m',
        'ends',
        'beam_count',
        'beam_length_m',
        'cones',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'warp_length_m' => 'decimal:3',
            'beam_length_m' => 'decimal:3',
        ];
    }

    public function productionPlan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ProductionPlan::class, 'production_plan_id');
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
