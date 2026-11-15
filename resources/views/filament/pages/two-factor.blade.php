<x-filament-panels::page>
    @php($user = auth()->user())
    @if (! $user->requiresTwoFactor())
        <p>This role does not use an authenticator.</p>
    @elseif ($user->two_factor_confirmed_at)
        <p>Authenticator already confirmed for {{ $user->email }}.</p>
    @else
        <p class="mb-4">Enter the code from your authenticator. Secret: {{ $user->two_factor_secret }}</p>
        <form wire:submit="confirm" class="grid max-w-xs gap-3">
            <input wire:model="code" class="rounded border px-3 py-2" inputmode="numeric" autocomplete="one-time-code">
            @error('code') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            <button type="submit" class="rounded bg-amber-600 px-4 py-2 text-sm font-semibold text-white">Confirm</button>
        </form>
    @endif
</x-filament-panels::page>
