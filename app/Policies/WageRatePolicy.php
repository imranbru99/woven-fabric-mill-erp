<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\WageRate;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class WageRatePolicy
{
    use MillPolicy;

    protected string $ability = 'WageRate';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, WageRate $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, WageRate $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, WageRate $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, WageRate $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, WageRate $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
