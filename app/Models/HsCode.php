<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class HsCode extends MillModel
{
    use HasFactory;

    protected $table = 'hs_codes';

    protected $fillable = [
        'code',
        'description',
        'duty_pct',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'duty_pct' => 'decimal:3',
        ];
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
