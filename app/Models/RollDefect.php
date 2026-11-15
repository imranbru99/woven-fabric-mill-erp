<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class RollDefect extends MillModel
{
    use HasFactory;

    protected $table = 'roll_defects';

    protected $fillable = [
        'fabric_roll_id',
        'defect_id',
        'position_m',
        'length_inch',
        'points',
        'photo_path',
        'inspector_id',
        'human_confirmed',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'position_m' => 'decimal:3',
            'length_inch' => 'decimal:2',
            'human_confirmed' => 'boolean',
        ];
    }

    public function fabricRoll(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricRoll::class, 'fabric_roll_id');
    }

    public function defect(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Defect::class, 'defect_id');
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'inspector_id');
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
