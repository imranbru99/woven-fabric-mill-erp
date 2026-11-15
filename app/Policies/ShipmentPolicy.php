<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Shipment;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class ShipmentPolicy
{
    use MillPolicy;

    protected string $ability = 'Shipment';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, Shipment $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, Shipment $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, Shipment $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, Shipment $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, Shipment $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
