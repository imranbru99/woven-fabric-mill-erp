<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JobworkChallan extends MillModel
{
    use HasFactory;

    protected $table = 'jobwork_challans';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'subcontractor_id',
        'finishing_batch_id',
        'direction',
        'metres',
        'challan_date',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'metres' => 'decimal:3',
            'challan_date' => 'date',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function subcontractor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'subcontractor_id');
    }

    public function finishingBatch(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FinishingBatch::class, 'finishing_batch_id');
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
