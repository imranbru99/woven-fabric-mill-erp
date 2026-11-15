<x-filament-panels::page>
    <form wire:submit="saveProduction" class="mb-8 grid gap-3 rounded-lg border p-4 md:grid-cols-4">
        <label class="grid gap-1 text-sm">Loom
            <select wire:model="loomId" class="rounded border px-3 py-3 text-lg">
                <option value="">—</option>
                @foreach ($looms as $loom)
                    <option value="{{ $loom->id }}">{{ $loom->code }}</option>
                @endforeach
            </select>
        </label>
        <label class="grid gap-1 text-sm">Article
            <select wire:model="articleId" class="rounded border px-3 py-3 text-lg">
                <option value="">—</option>
                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->code }}</option>
                @endforeach
            </select>
        </label>
        <label class="grid gap-1 text-sm">Picks
            <input wire:model="picks" type="number" min="1" class="rounded border px-3 py-3 text-lg">
        </label>
        <button type="submit" class="self-end rounded bg-amber-600 px-4 py-3 text-lg font-semibold text-white">Save shift</button>
    </form>
    <ul class="grid gap-4 md:grid-cols-2">
        @foreach ($looms as $loom)
            <li class="rounded-lg border p-4">
                <h2 class="text-2xl font-semibold">{{ $loom->code }}</h2>
                <p class="text-sm text-gray-600">{{ $loom->status }} · {{ $loom->rpm }} rpm</p>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    @foreach ($reasons as $code => $label)
                        <button type="button" wire:click="stop({{ $loom->id }}, '{{ $code }}')" class="rounded bg-stone-900 px-3 py-4 text-base font-semibold text-white">{{ $label }}</button>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</x-filament-panels::page>
