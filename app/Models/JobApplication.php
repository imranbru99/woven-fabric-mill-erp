<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class JobApplication extends MillModel
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'recruitment_id',
        'job_opening_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'status',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function recruitment(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Recruitment::class, 'recruitment_id');
    }

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(\App\Models\JobOpening::class, 'job_opening_id');
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
