<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Pages\Page;
use PragmaRX\Google2FA\Google2FA;

class TwoFactor extends Page
{
    protected static ?string $slug = 'two-factor';

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.two-factor';

    public string $code = '';

    public function mount(): void
    {
        $user = auth()->user();
        if ($user && $user->requiresTwoFactor() && ! $user->two_factor_secret) {
            $user->two_factor_secret = (new Google2FA)->generateSecretKey();
            $user->save();
        }
    }

    public function confirm(): void
    {
        $user = auth()->user();
        $valid = (new Google2FA)->verifyKey((string) $user->two_factor_secret, $this->code);
        if (! $valid) {
            $this->addError('code', 'That code does not match the authenticator.');

            return;
        }
        $user->two_factor_confirmed_at = now();
        $user->save();
        $this->redirect('/admin');
    }
}
