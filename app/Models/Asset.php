<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Asset extends MillModel
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'code',
        'name',
        'machine_id',
        'category',
        'commissioned_on',
        'warranty_until',
        'manual_ref',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'commissioned_on' => 'date',
            'warranty_until' => 'date',
        ];
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'machine_id');
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
