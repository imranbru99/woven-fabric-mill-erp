<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JobworkChallanLine extends MillModel
{
    use HasFactory;

    protected $table = 'jobwork_challan_lines';

    protected $fillable = [
        'jobwork_challan_id',
        'fabric_roll_id',
        'metres',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'metres' => 'decimal:3',
        ];
    }

    public function jobworkChallan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobworkChallan::class, 'jobwork_challan_id');
    }

    public function fabricRoll(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricRoll::class, 'fabric_roll_id');
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
