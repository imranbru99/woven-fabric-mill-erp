<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class DrawingJob extends MillModel
{
    use HasFactory;

    protected $table = 'drawing_jobs';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'weaver_beam_id',
        'article_id',
        'reed_id',
        'heald_frame_id',
        'operator_id',
        'method',
        'wrong_draws',
        'double_ends',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function weaverBeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WeaverBeam::class, 'weaver_beam_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function reed(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Reed::class, 'reed_id');
    }

    public function healdFrame(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HealdFrame::class, 'heald_frame_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'operator_id');
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
