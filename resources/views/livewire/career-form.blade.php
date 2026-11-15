<div>
    @if ($sent)
        <p role="status">{{ __('site.sent') }}</p>
    @else
        <form wire:submit="save" class="grid gap-4">
            <label class="grid gap-1 text-sm">{{ __('site.form.contact') }}
                <input class="border border-stone-400 px-3 py-2" wire:model="name" required>
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.email') }}
                <input class="border border-stone-400 px-3 py-2" type="email" wire:model="email" required>
            </label>
            @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">{{ __('site.form.phone') }}
                <input class="border border-stone-400 px-3 py-2" wire:model="phone">
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.opening') }}
                <select class="border border-stone-400 px-3 py-2" wire:model="job_opening_id">
                    <option value="">—</option>
                    @foreach ($openings as $opening)
                        <option value="{{ $opening->id }}">{{ $opening->title }}</option>
                    @endforeach
                </select>
            </label>
            <label class="grid gap-1 text-sm">{{ __('site.form.letter') }}
                <textarea class="border border-stone-400 px-3 py-2" wire:model="cover_letter" rows="5" required></textarea>
            </label>
            <label class="absolute -left-[9999px]" aria-hidden="true">{{ __('site.form.honeypot') }}
                <input wire:model="website_url" tabindex="-1" autocomplete="off">
            </label>
            <button class="bg-stone-950 px-4 py-3 text-sm font-semibold text-stone-50" type="submit">{{ __('site.form.submit') }}</button>
        </form>
    @endif
</div>
