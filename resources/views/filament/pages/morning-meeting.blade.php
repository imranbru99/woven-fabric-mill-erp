<x-filament-panels::page>
    <section class="grid gap-6">
        <dl class="grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border p-4"><dt>Metres today</dt><dd class="text-2xl font-semibold">{{ $metres['total'] }}</dd></div>
            <div class="rounded-lg border p-4"><dt>Efficiency today</dt><dd class="text-2xl font-semibold">{{ $efficiency['total'] }}</dd></div>
            <div class="rounded-lg border p-4"><dt>Stoppage minutes</dt><dd class="text-2xl font-semibold">{{ $stoppages['total'] }}</dd></div>
        </dl>
        <ol class="divide-y rounded-lg border">
            @foreach ($issues as $issue)
                <li class="px-4 py-3">
                    <span class="font-semibold">{{ $issue->number }}</span>
                    {{ $issue->severity }} · {{ $issue->rule_code }} · {{ $issue->root_cause }}
                </li>
            @endforeach
        </ol>
    </section>
</x-filament-panels::page>
