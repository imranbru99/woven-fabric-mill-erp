<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ApprovalStep;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class ApprovalStepPolicy
{
    use MillPolicy;

    protected string $ability = 'ApprovalStep';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, ApprovalStep $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, ApprovalStep $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, ApprovalStep $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, ApprovalStep $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, ApprovalStep $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
