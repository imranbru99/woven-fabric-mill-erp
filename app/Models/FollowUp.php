<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class FollowUp extends MillModel
{
    use HasFactory;

    protected $table = 'follow_ups';

    protected $fillable = [
        'inquiry_id',
        'due_on',
        'channel',
        'notes',
        'is_done',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'due_on' => 'date',
            'is_done' => 'boolean',
        ];
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Inquiry::class, 'inquiry_id');
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
