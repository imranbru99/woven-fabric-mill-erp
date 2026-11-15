<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class ApprovalStep extends MillModel
{
    use HasFactory;

    protected $table = 'approval_steps';

    protected $fillable = [
        'approval_flow_id',
        'step_no',
        'role_slug',
        'min_amount',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'min_amount' => 'decimal:2',
        ];
    }

    public function approvalFlow(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ApprovalFlow::class, 'approval_flow_id');
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
