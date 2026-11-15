<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class Company extends MillModel
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'legal_name',
        'country',
        'currency_code',
        'timezone',
        'tax_id',
        'bin_vat',
        'address',
        'phone',
        'email',
        'about',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [];
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
