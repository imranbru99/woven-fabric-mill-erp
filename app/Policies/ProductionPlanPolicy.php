<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ProductionPlan;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class ProductionPlanPolicy
{
    use MillPolicy;

    protected string $ability = 'ProductionPlan';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, ProductionPlan $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, ProductionPlan $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, ProductionPlan $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, ProductionPlan $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, ProductionPlan $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
