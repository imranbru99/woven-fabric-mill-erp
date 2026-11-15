<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class TaxRule extends MillModel
{
    use HasFactory;

    protected $table = 'tax_rules';

    protected $fillable = [
        'code',
        'name',
        'country',
        'kind',
        'rate_pct',
        'form_code',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'rate_pct' => 'decimal:4',
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
