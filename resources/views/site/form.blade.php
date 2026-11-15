@extends('site.layout')

@section('content')
    <section class="mx-auto max-w-xl px-4 py-14">
        <h1 class="text-4xl font-semibold">{{ $title }}</h1>
        <div class="mt-8 border border-stone-300 bg-white p-5">
            @if ($form === 'sample')
                <livewire:sample-request-form />
            @elseif ($form === 'rfq')
                <livewire:rfq-form />
            @else
                <livewire:career-form />
            @endif
        </div>
    </section>
@endsection
