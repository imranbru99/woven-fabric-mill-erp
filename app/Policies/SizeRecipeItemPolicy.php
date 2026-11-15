<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\SizeRecipeItem;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class SizeRecipeItemPolicy
{
    use MillPolicy;

    protected string $ability = 'SizeRecipeItem';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, SizeRecipeItem $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, SizeRecipeItem $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, SizeRecipeItem $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, SizeRecipeItem $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, SizeRecipeItem $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
