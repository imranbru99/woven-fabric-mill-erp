<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LabTestResult extends MillModel
{
    use HasFactory;

    protected $table = 'lab_test_results';

    protected $fillable = [
        'lab_test_id',
        'parameter',
        'value',
        'unit',
        'min_limit',
        'max_limit',
        'passed',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'min_limit' => 'decimal:4',
            'max_limit' => 'decimal:4',
            'passed' => 'boolean',
        ];
    }

    public function labTest(): BelongsTo
    {
        return $this->belongsTo(\App\Models\LabTest::class, 'lab_test_id');
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
