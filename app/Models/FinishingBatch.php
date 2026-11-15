<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class FinishingBatch extends MillModel
{
    use HasFactory;

    protected $table = 'finishing_batches';

    protected $fillable = [
        'number',
        'status',
        'version',
        'approved_at',
        'approved_by',
        'article_id',
        'subcontractor_id',
        'process_route',
        'shade',
        'grey_m',
        'finished_m',
        'process_loss_pct',
        'rate_per_m',
        'cost',
        'is_reprocess',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'grey_m' => 'decimal:3',
            'finished_m' => 'decimal:3',
            'process_loss_pct' => 'decimal:2',
            'rate_per_m' => 'decimal:4',
            'cost' => 'decimal:2',
            'is_reprocess' => 'boolean',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FabricArticle::class, 'article_id');
    }

    public function subcontractor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Party::class, 'subcontractor_id');
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
