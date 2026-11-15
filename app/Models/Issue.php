<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Issue extends MillModel
{
    use HasFactory;

    protected $table = 'issues';

    protected $fillable = [
        'number',
        'issue_type',
        'severity',
        'source',
        'rule_code',
        'related_type',
        'related_id',
        'department_id',
        'assigned_to',
        'escalation_level',
        'status',
        'sla_due_at',
        'root_cause',
        'five_why',
        'corrective_action',
        'preventive_action',
        'cost_impact',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'sla_due_at' => 'datetime',
            'five_why' => 'array',
            'cost_impact' => 'decimal:2',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
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
