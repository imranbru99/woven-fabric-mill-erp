<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class LoomSetup extends MillModel
{
    use HasFactory;

    protected $table = 'loom_setups';

    protected $fillable = [
        'loom_id',
        'article_id',
        'weaver_beam_id',
        'reed_id',
        'speed',
        'settings',
        'setup_minutes',
        'operator_id',
        'started_at',
        'finished_at',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function loom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Machine::class, 'loom_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function weaverBeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\WeaverBeam::class, 'weaver_beam_id');
    }

    public function reed(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Reed::class, 'reed_id');
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
