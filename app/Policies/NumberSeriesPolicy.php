<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\NumberSeries;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class NumberSeriesPolicy
{
    use MillPolicy;

    protected string $ability = 'NumberSeries';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, NumberSeries $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, NumberSeries $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, NumberSeries $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, NumberSeries $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, NumberSeries $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
