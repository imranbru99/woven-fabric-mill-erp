<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class DocumentCheck extends MillModel
{
    use HasFactory;

    protected $table = 'document_checks';

    protected $fillable = [
        'lc_id',
        'commercial_invoice_id',
        'document_name',
        'is_present',
        'matches_lc',
        'discrepancy',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'is_present' => 'boolean',
            'matches_lc' => 'boolean',
        ];
    }

    public function lc(): BelongsTo
    {
        return $this->belongsTo(\App\Models\LetterOfCredit::class, 'lc_id');
    }

    public function commercialInvoice(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CommercialInvoice::class, 'commercial_invoice_id');
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
