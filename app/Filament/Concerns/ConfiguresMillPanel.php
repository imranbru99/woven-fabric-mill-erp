<?php

declare(strict_types=1);

namespace App\Filament\Concerns;

use App\Http\Middleware\EnsureTwoFactor;
use App\Http\Middleware\RestrictAdminIp;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

trait ConfiguresMillPanel
{
    protected function mill(Panel $panel, string $id, string $path): Panel
    {
        return $panel
            ->id($id)
            ->path($path)
            ->login()
            ->brandName('Dhaka Woven Mills')
            ->colors(['primary' => Color::Amber])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                RestrictAdminIp::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                EnsureTwoFactor::class,
            ]);
    }
}
