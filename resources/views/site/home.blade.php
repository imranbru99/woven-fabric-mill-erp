@extends('site.layout')

@section('content')
    <section class="bg-stone-950 text-stone-50">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-16 md:grid-cols-5">
            <div class="md:col-span-3">
                <p class="text-sm uppercase tracking-widest text-amber-200">{{ __('site.home.kicker') }}</p>
                <h1 class="mt-4 max-w-xl text-4xl font-semibold leading-tight md:text-5xl">{{ __('site.home.title') }}</h1>
                <p class="mt-6 max-w-xl text-lg text-stone-300">{{ __('site.home.lede') }}</p>
                <p class="mt-8 flex flex-wrap gap-3">
                    <a class="bg-amber-300 px-4 py-3 text-sm font-semibold text-stone-950" href="{{ route('sample') }}">{{ __('site.home.cta_sample') }}</a>
                    <a class="border border-stone-500 px-4 py-3 text-sm font-semibold" href="{{ route('rfq') }}">{{ __('site.home.cta_rfq') }}</a>
                </p>
            </div>
            <dl class="grid grid-cols-2 gap-4 md:col-span-2">
                @foreach (['looms' => $stats['looms'], 'capacity' => $stats['capacity'], 'articles' => $stats['articles'], 'markets' => $stats['markets']] as $key => $value)
                    <div class="border border-stone-700 p-4">
                        <dt class="text-xs uppercase tracking-wide text-stone-400">{{ __('site.home.stats.'.$key) }}</dt>
                        <dd class="mt-2 text-3xl font-semibold">{{ number_format($value) }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>
    <section class="mx-auto max-w-6xl px-4 py-14">
        <h2 class="text-2xl font-semibold">{{ __('site.nav.fabrics') }}</h2>
        <ul class="mt-6 grid gap-4 md:grid-cols-3">
            @forelse ($articles as $article)
                <li class="border border-stone-300 bg-white p-4">
                    <a class="text-lg font-semibold underline-offset-4 hover:underline" href="{{ route('fabric', $article->slug) }}">{{ $article->name }}</a>
                    <p class="mt-2 text-sm text-stone-600">{{ $article->weave }} · {{ $article->composition }} · {{ $article->calculated_gsm }} GSM</p>
                </li>
            @empty
                <li class="text-stone-600">{{ __('site.pages.downloads.body') }}</li>
            @endforelse
        </ul>
    </section>
@endsection

@php
    $title = __('site.name');
    $description = __('site.tagline');
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => __('site.name'),
        'description' => __('site.tagline'),
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Gazipur', 'addressCountry' => 'BD'],
    ];
@endphp
