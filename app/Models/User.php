<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
        'unit_id',
        'employee_id',
        'locale',
        'is_active',
        'two_factor_secret',
        'two_factor_confirmed_at',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'two_factor_secret' => 'encrypted',
            'two_factor_confirmed_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')->withPivot(['branch_id', 'unit_id']);
    }

    public function hasRole(string $slug): bool
    {
        return $this->roles->contains(fn (Role $role): bool => $role->slug === $slug);
    }

    public function hasAnyRole(array $slugs): bool
    {
        return $this->roles->contains(fn (Role $role): bool => in_array($role->slug, $slugs, true));
    }

    public function hasPermission(string $ability): bool
    {
        return $this->roles->flatMap->permissions->contains(fn (Permission $permission): bool => $permission->name === $ability);
    }

    public function isBuyer(): bool
    {
        return $this->hasRole('buyer');
    }

    public function isSupplier(): bool
    {
        return $this->hasRole('supplier');
    }

    public function isInternal(): bool
    {
        return $this->is_active && ! $this->isBuyer() && ! $this->isSupplier() && $this->roles->isNotEmpty();
    }

    public function canSeeCosts(): bool
    {
        return $this->hasAnyRole([
            'owner', 'managing-director', 'accountant', 'accounts-manager', 'auditor',
            'commercial-manager', 'merchandiser', 'it-admin',
        ]) || $this->hasPermission('view-costs');
    }

    public function requiresTwoFactor(): bool
    {
        return (bool) $this->roles->first(fn (Role $role): bool => (bool) $role->requires_two_factor);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->is_active) {
            return false;
        }

        return match ($panel->getId()) {
            'admin' => $this->isInternal() || $this->hasAnyRole(['owner', 'it-admin']),
            'buyer' => $this->isBuyer() || $this->hasAnyRole(['owner', 'merchandiser']),
            'supplier' => $this->isSupplier() || $this->hasRole('purchase-manager'),
            'floor' => $this->hasAnyRole([
                'owner', 'loom-operator', 'loom-supervisor', 'weaving-manager',
                'inspector', 'mechanic', 'preparatory-incharge', 'factory-manager',
            ]),
            default => false,
        };
    }
}
