<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PayrollLine;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class PayrollLinePolicy
{
    use MillPolicy;

    protected string $ability = 'PayrollLine';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, PayrollLine $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, PayrollLine $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, PayrollLine $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, PayrollLine $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, PayrollLine $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
