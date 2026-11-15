<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class FabricRoll extends MillModel
{
    use HasFactory;

    protected $table = 'fabric_rolls';

    protected $fillable = [
        'number',
        'article_id',
        'loom_id',
        'operator_id',
        'shift_id',
        'weaver_beam_id',
        'sizing_batch_id',
        'warp_lot_id',
        'weft_lot_id',
        'job_card_id',
        'length_m',
        'weight_kg',
        'grey_width_cm',
        'gsm',
        'grade',
        'points',
        'inspection_system',
        'status',
        'doffed_at',
        'barcode',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'length_m' => 'decimal:3',
            'weight_kg' => 'decimal:3',
            'grey_width_cm' => 'decimal:2',
            'gsm' => 'decimal:2',
            'points' => 'decimal:2',
            'doffed_at' => 'datetime',
        ];
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function loom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'loom_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'operator_id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Shift::class, 'shift_id');
    }

    public function weaverBeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WeaverBeam::class, 'weaver_beam_id');
    }

    public function sizingBatch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SizingBatch::class, 'sizing_batch_id');
    }

    public function warpLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'warp_lot_id');
    }

    public function weftLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'weft_lot_id');
    }

    public function jobCard(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobCard::class, 'job_card_id');
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
