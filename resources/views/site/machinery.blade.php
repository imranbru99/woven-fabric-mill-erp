@extends('site.layout')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-14">
        <h1 class="text-4xl font-semibold">{{ __('site.nav.machinery') }}</h1>
        <ul class="mt-8 divide-y divide-stone-300 border border-stone-300 bg-white">
            @forelse ($machines as $machine)
                <li class="grid gap-2 px-4 py-4 md:grid-cols-4">
                    <span class="font-semibold">{{ $machine->code }}</span>
                    <span>{{ $machine->name }}</span>
                    <span>{{ $machine->make }} {{ $machine->model_name }}</span>
                    <span>{{ $machine->machine_type }} · {{ $machine->rpm }} rpm</span>
                </li>
            @empty
                <li class="px-4 py-4">{{ __('site.pages.facilities.body') }}</li>
            @endforelse
        </ul>
    </section>
@endsection
