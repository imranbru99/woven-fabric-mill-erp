<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LeaveType extends MillModel
{
    use HasFactory;

    protected $table = 'leave_types';

    protected $fillable = [
        'code',
        'name',
        'days_per_year',
        'paid',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'paid' => 'boolean',
        ];
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
