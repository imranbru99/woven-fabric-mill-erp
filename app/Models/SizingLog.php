<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SizingLog extends MillModel
{
    use HasFactory;

    protected $table = 'sizing_logs';

    protected $fillable = [
        'sizing_batch_id',
        'section_beam_id',
        'beam_no',
        'warp_length_m',
        'speed',
        'size_box_temp',
        'squeeze_pressure',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'warp_length_m' => 'decimal:3',
            'size_box_temp' => 'decimal:2',
            'squeeze_pressure' => 'decimal:2',
        ];
    }

    public function sizingBatch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SizingBatch::class, 'sizing_batch_id');
    }

    public function sectionBeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SectionBeam::class, 'section_beam_id');
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
