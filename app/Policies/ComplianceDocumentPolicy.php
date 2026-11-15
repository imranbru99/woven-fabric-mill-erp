<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ComplianceDocument;
use App\Models\User;
use App\Policies\Concerns\MillPolicy;

class ComplianceDocumentPolicy
{
    use MillPolicy;

    protected string $ability = 'ComplianceDocument';

    public function viewAny(User $user): bool
    {
        return $this->allow($user, 'view-any');
    }

    public function view(User $user, ComplianceDocument $record): bool
    {
        return $this->allow($user, 'view', $record);
    }

    public function create(User $user): bool
    {
        return $this->allow($user, 'create');
    }

    public function update(User $user, ComplianceDocument $record): bool
    {
        return $this->allow($user, 'update', $record);
    }

    public function delete(User $user, ComplianceDocument $record): bool
    {
        return $this->allow($user, 'delete', $record);
    }

    public function restore(User $user, ComplianceDocument $record): bool
    {
        return $this->allow($user, 'restore', $record);
    }

    public function forceDelete(User $user, ComplianceDocument $record): bool
    {
        return $this->allow($user, 'force-delete', $record);
    }
}
