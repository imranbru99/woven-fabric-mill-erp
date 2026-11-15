<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class RolePolicy
{
    use MillPolicy;

    protected string $ability = 'Role';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, Role $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, Role $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, Role $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, Role $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, Role $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
