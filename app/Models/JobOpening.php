<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JobOpening extends MillModel
{
    use HasFactory;

    protected $table = 'job_openings';

    protected $fillable = [
        'title',
        'slug',
        'department_id',
        'recruitment_id',
        'description',
        'closes_on',
        'is_published',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'closes_on' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    public function recruitment(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Recruitment::class, 'recruitment_id');
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
