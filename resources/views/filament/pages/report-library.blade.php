<x-filament-panels::page>
    <form wire:submit="runReport" class="flex flex-wrap items-end gap-3">
        <label class="grid gap-1 text-sm">
            Report
            <select wire:model="report" class="min-w-80 rounded border px-3 py-2">
                @foreach ($reports as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </label>
        <button type="submit" class="rounded bg-amber-600 px-4 py-2 text-sm font-semibold text-white">Run</button>
    </form>
    @if ($result)
        <p class="mt-6 text-lg">Total {{ $result['total'] }}</p>
        <table class="mt-3 w-full text-sm">
            @foreach ($result['rows'] as $row)
                <tr>
                    <td class="border-b py-2">{{ $row['bucket'] }}</td>
                    <td class="border-b py-2 text-right">{{ $row['value'] }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</x-filament-panels::page>
