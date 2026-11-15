<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LoomProduction extends MillModel
{
    use HasFactory;

    protected $table = 'loom_productions';

    protected $fillable = [
        'loom_id',
        'shift_id',
        'operator_id',
        'article_id',
        'job_card_id',
        'weaver_beam_id',
        'production_date',
        'picks',
        'rpm',
        'minutes',
        'efficiency',
        'metres',
        'warp_breaks',
        'weft_breaks',
        'stoppage_minutes',
        'source',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'production_date' => 'date',
            'efficiency' => 'decimal:2',
            'metres' => 'decimal:3',
        ];
    }

    public function loom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'loom_id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Shift::class, 'shift_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'operator_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function jobCard(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobCard::class, 'job_card_id');
    }

    public function weaverBeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WeaverBeam::class, 'weaver_beam_id');
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
