<div>
    @if ($sent)
        <p role="status">{{ __('site.sent') }}</p>
    @else
        <form wire:submit="save" class="grid gap-4">
            <label class="grid gap-1 text-sm">{{ __('site.form.company') }}
                <input class="border border-stone-400 px-3 py-2" wire:model="company_name" required>
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.contact') }}
                <input class="border border-stone-400 px-3 py-2" wire:model="contact_name">
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.email') }}
                <input class="border border-stone-400 px-3 py-2" type="email" wire:model="email" required>
            </label>
            @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">{{ __('site.form.phone') }}
                <input class="border border-stone-400 px-3 py-2" wire:model="phone">
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.requirement') }}
                <textarea class="border border-stone-400 px-3 py-2" wire:model="requirement" rows="5" required></textarea>
            </label>
            <label class="absolute -left-[9999px]" aria-hidden="true">{{ __('site.form.honeypot') }}
                <input wire:model="website_url" tabindex="-1" autocomplete="off">
            </label>
            <button class="bg-stone-950 px-4 py-3 text-sm font-semibold text-stone-50" type="submit">{{ __('site.form.submit') }}</button>
        </form>
    @endif
</div>
