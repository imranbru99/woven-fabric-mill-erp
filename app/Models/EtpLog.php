<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class EtpLog extends MillModel
{
    use HasFactory;

    protected $table = 'etp_logs';

    protected $fillable = [
        'logged_at',
        'inlet_ph',
        'outlet_ph',
        'inlet_bod',
        'outlet_bod',
        'sludge_kg',
        'within_limit',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'logged_at' => 'datetime',
            'inlet_ph' => 'decimal:2',
            'outlet_ph' => 'decimal:2',
            'inlet_bod' => 'decimal:2',
            'outlet_bod' => 'decimal:2',
            'sludge_kg' => 'decimal:3',
            'within_limit' => 'boolean',
        ];
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
