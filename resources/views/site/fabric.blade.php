@extends('site.layout')

@php
    $title = $article->name;
    $description = $article->composition.' '.$article->weave;
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $article->name,
        'sku' => $article->code,
        'description' => trim($article->composition.' '.$article->weave),
        'brand' => ['@type' => 'Brand', 'name' => __('site.name')],
    ];
@endphp

@section('content')
    <article class="mx-auto max-w-3xl px-4 py-14">
        <p class="text-sm uppercase tracking-widest text-stone-500">{{ $article->code }}</p>
        <h1 class="mt-3 text-4xl font-semibold">{{ $article->name }}</h1>
        <dl class="mt-8 grid grid-cols-2 gap-4 text-sm">
            <div class="border border-stone-300 bg-white p-4"><dt>Weave</dt><dd class="text-lg font-semibold">{{ $article->weave }}</dd></div>
            <div class="border border-stone-300 bg-white p-4"><dt>Composition</dt><dd class="text-lg font-semibold">{{ $article->composition }}</dd></div>
            <div class="border border-stone-300 bg-white p-4"><dt>EPI × PPI</dt><dd class="text-lg font-semibold">{{ $article->epi }} × {{ $article->ppi }}</dd></div>
            <div class="border border-stone-300 bg-white p-4"><dt>Grey GSM</dt><dd class="text-lg font-semibold">{{ $article->calculated_gsm }}</dd></div>
            <div class="border border-stone-300 bg-white p-4"><dt>Grey width</dt><dd class="text-lg font-semibold">{{ $article->grey_width_cm }} cm</dd></div>
            <div class="border border-stone-300 bg-white p-4"><dt>Ends</dt><dd class="text-lg font-semibold">{{ $article->total_ends }}</dd></div>
        </dl>
        <p class="mt-8"><a class="bg-stone-950 px-4 py-3 text-sm font-semibold text-stone-50" href="{{ route('sample') }}">{{ __('site.sample_title') }}</a></p>
    </article>
@endsection
