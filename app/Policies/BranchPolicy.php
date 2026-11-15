<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class BranchPolicy
{
    use MillPolicy;

    protected string $ability = 'Branch';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, Branch $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, Branch $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, Branch $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, Branch $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, Branch $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
