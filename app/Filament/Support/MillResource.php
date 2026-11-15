<?php

declare(strict_types=1);

namespace App\Filament\Support;

use Filament\Forms\Form;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table;
use ImranDev\FilamentMaster\Resources\BaseResource;

abstract class MillResource extends BaseResource
{
    public static function form(Form $form): Form
    {
        return $form->schema(static::visibleComponents(static::getGeneratedFormSchema()));
    }

    public static function table(Table $table): Table
    {
        $table = parent::table($table);
        $user = auth()->user();
        if ($user && ! $user->canSeeCosts()) {
            $columns = array_values(array_filter(
                $table->getColumns(),
                fn (Column $column): bool => ! static::isSensitive((string) $column->getName())
            ));
            $table->columns($columns);
        }

        return $table;
    }

    /**
     * @param  array<int, mixed>  $components
     * @return array<int, mixed>
     */
    protected static function visibleComponents(array $components): array
    {
        $user = auth()->user();
        if ($user === null || $user->canSeeCosts()) {
            return $components;
        }

        return array_values(array_filter($components, function ($component): bool {
            $name = method_exists($component, 'getName') ? (string) $component->getName() : '';

            return ! static::isSensitive($name);
        }));
    }

    public static function isSensitive(string $field): bool
    {
        $needles = ['rate', 'cost', 'amount', 'price', 'salary', 'wage', 'margin', 'profit', 'debit', 'credit', 'balance', 'principal', 'emi'];
        $field = strtolower($field);
        foreach ($needles as $needle) {
            if (str_contains($field, $needle)) {
                return true;
            }
        }

        return false;
    }
}
