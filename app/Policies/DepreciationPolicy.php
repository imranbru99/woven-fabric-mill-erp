<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Depreciation;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class DepreciationPolicy
{
    use MillPolicy;

    protected string $ability = 'Depreciation';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, Depreciation $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, Depreciation $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, Depreciation $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, Depreciation $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, Depreciation $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
