<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class PayrollLine extends MillModel
{
    use HasFactory;

    protected $table = 'payroll_lines';

    protected $fillable = [
        'payroll_run_id',
        'employee_id',
        'basic',
        'piece',
        'overtime',
        'bonus',
        'advance',
        'deduction',
        'tax',
        'net',
        'metres',
        'picks',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'basic' => 'decimal:2',
            'piece' => 'decimal:2',
            'overtime' => 'decimal:2',
            'bonus' => 'decimal:2',
            'advance' => 'decimal:2',
            'deduction' => 'decimal:2',
            'tax' => 'decimal:2',
            'net' => 'decimal:2',
            'metres' => 'decimal:3',
        ];
    }

    public function payrollRun(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PayrollRun::class, 'payroll_run_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
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
