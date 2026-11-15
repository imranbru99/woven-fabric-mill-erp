<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class WarpingJob extends MillModel
{
    use HasFactory;

    protected $table = 'warping_jobs';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'job_card_id',
        'article_id',
        'yarn_id',
        'yarn_lot_id',
        'machine_id',
        'operator_id',
        'shift_id',
        'ends',
        'beam_length_m',
        'speed',
        'stops',
        'breakage_per_million',
        'yarn_issued_kg',
        'yarn_consumed_kg',
        'soft_waste_kg',
        'hard_waste_kg',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'beam_length_m' => 'decimal:3',
            'breakage_per_million' => 'decimal:2',
            'yarn_issued_kg' => 'decimal:3',
            'yarn_consumed_kg' => 'decimal:3',
            'soft_waste_kg' => 'decimal:3',
            'hard_waste_kg' => 'decimal:3',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function jobCard(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobCard::class, 'job_card_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function yarn(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Yarn::class, 'yarn_id');
    }

    public function yarnLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'yarn_lot_id');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'operator_id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Shift::class, 'shift_id');
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
