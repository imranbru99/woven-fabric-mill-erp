<?php

declare(strict_types=1);

namespace ImranDev\Adhikar;

use App\Models\FieldPermission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * In-app Adhikar adapter. The Packagist package imrandevbd/adhikar is not published.
 * Filament Master detects this class and permission model.
 */
class Adhikar
{
    public static function allows(User $user, string $ability, ?Model $record = null): bool
    {
        if (! $user->is_active) {
            return false;
        }

        if ($user->hasAnyRole(['owner', 'it-admin', 'managing-director'])) {
            return true;
        }

        if ($user->hasPermission($ability)) {
            return true;
        }

        if ($record && method_exists($record, 'getAttribute') && $record->getAttribute('created_by') === $user->id && str_starts_with($ability, 'view')) {
            return true;
        }

        if ($user->isBuyer() || $user->isSupplier()) {
            return str_starts_with($ability, 'view');
        }

        return $user->isInternal() && ! str_contains($ability, 'force-delete');
    }

    public static function scopeBranch(Builder $query, User $user): Builder
    {
        if ($user->hasAnyRole(['owner', 'managing-director', 'auditor', 'it-admin']) || $user->branch_id === null) {
            return $query;
        }

        if (Schema::hasColumn($query->getModel()->getTable(), 'branch_id')) {
            $query->where($query->getModel()->getTable().'.branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function canSeeField(User $user, string $resource, string $field): bool
    {
        if ($user->canSeeCosts()) {
            return true;
        }

        $rule = FieldPermission::query()
            ->whereIn('role_id', $user->roles->pluck('id'))
            ->where('resource', $resource)
            ->where('field', $field)
            ->first();

        return (bool) ($rule?->can_view);
    }
}
