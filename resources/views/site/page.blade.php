@extends('site.layout')

@section('content')
    <article class="mx-auto max-w-3xl px-4 py-14">
        <p class="text-sm uppercase tracking-widest text-stone-500">{{ __('site.name') }}</p>
        <h1 class="mt-3 text-4xl font-semibold">{{ $title }}</h1>
        <div class="mt-6 space-y-4 text-lg leading-relaxed">{!! nl2br(e($body)) !!}</div>
        @if ($certificates->isNotEmpty())
            <ul class="mt-8 space-y-2">
                @foreach ($certificates as $certificate)
                    <li class="border border-stone-300 bg-white px-4 py-3">{{ $certificate->name }} @if ($certificate->expires_on) · {{ $certificate->expires_on }} @endif</li>
                @endforeach
            </ul>
        @endif
    </article>
@endsection
