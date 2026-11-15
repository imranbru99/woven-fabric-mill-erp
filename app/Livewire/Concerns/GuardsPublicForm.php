<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

trait GuardsPublicForm
{
    public string $website_url = '';

    public string $turnstile_token = '';

    protected function allowed(): bool
    {
        if ($this->website_url !== '') {
            return false;
        }

        $key = 'public-form:'.request()->ip();
        if (RateLimiter::tooManyAttempts($key, 8)) {
            $this->addError('email', __('site.too_many'));

            return false;
        }
        RateLimiter::hit($key, 60);

        $secret = config('mill.turnstile_secret');
        if (! $secret) {
            return true;
        }

        $ok = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secret,
            'response' => $this->turnstile_token,
            'remoteip' => request()->ip(),
        ])->json('success');

        if (! $ok) {
            $this->addError('email', __('site.captcha'));

            return false;
        }

        return true;
    }
}
