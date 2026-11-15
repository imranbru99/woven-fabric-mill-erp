<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\UtilityReading;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class UtilityReadingPolicy
{
    use MillPolicy;

    protected string $ability = 'UtilityReading';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, UtilityReading $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, UtilityReading $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, UtilityReading $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, UtilityReading $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, UtilityReading $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
