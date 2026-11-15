@extends('site.layout')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-14">
        <h1 class="text-4xl font-semibold">{{ __('site.nav.news') }}</h1>
        <ul class="mt-8 space-y-6">
            @forelse ($posts as $post)
                <li class="border border-stone-300 bg-white p-5">
                    <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                    <p class="mt-3">{{ $post->excerpt }}</p>
                </li>
            @empty
                <li>{{ __('site.pages.about.body') }}</li>
            @endforelse
        </ul>
    </section>
@endsection
