<?php

declare(strict_types=1);

namespace App\Policies\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use ImranDev\Adhikar\Adhikar;

trait MillPolicy
{
    protected function allow(User $user, string $action, ?Model $record = null): bool
    {
        return Adhikar::allows($user, $action.' '.$this->ability, $record);
    }
}
