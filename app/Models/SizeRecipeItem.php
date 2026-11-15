<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\MillModel;

class SizeRecipeItem extends MillModel
{
    use HasFactory;

    protected $table = 'size_recipe_items';

    protected $fillable = [
        'size_recipe_id',
        'chemical_id',
        'qty_per_kg',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'qty_per_kg' => 'decimal:4',
        ];
    }

    public function sizeRecipe(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SizeRecipe::class, 'size_recipe_id');
    }

    public function chemical(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Chemical::class, 'chemical_id');
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
