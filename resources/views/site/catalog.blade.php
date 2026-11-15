@extends('site.layout')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-14">
        <h1 class="text-4xl font-semibold">{{ __('site.nav.fabrics') }}</h1>
        <ul class="mt-8 grid gap-4 md:grid-cols-2">
            @forelse ($articles as $article)
                <li class="border border-stone-300 bg-white p-5">
                    <a class="text-xl font-semibold underline-offset-4 hover:underline" href="{{ route('fabric', $article->slug) }}">{{ $article->name }}</a>
                    <p class="mt-2 text-sm text-stone-600">{{ $article->code }} · {{ $article->weave }} · EPI {{ $article->epi }} · PPI {{ $article->ppi }} · {{ $article->grey_width_cm }} cm</p>
                </li>
            @empty
                <li>{{ __('site.pages.downloads.body') }}</li>
            @endforelse
        </ul>
    </section>
@endsection
