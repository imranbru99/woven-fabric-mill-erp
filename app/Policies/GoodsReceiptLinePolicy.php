<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\GoodsReceiptLine;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class GoodsReceiptLinePolicy
{
    use MillPolicy;

    protected string $ability = 'GoodsReceiptLine';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, GoodsReceiptLine $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, GoodsReceiptLine $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, GoodsReceiptLine $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, GoodsReceiptLine $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, GoodsReceiptLine $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
