<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class WarpingCreelPosition extends MillModel
{
    use HasFactory;

    protected $table = 'warping_creel_positions';

    protected $fillable = [
        'warping_job_id',
        'position_no',
        'yarn_lot_id',
        'cone_barcode',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function warpingJob(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WarpingJob::class, 'warping_job_id');
    }

    public function yarnLot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\YarnLot::class, 'yarn_lot_id');
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
