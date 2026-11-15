<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('site.name') }}</title>
    <meta name="description" content="{{ $description ?? __('site.tagline') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">
    <link rel="alternate" hreflang="bn" href="{{ request()->fullUrlWithQuery(['lang' => 'bn']) }}">
    <meta property="og:title" content="{{ $title ?? __('site.name') }}">
    <meta property="og:description" content="{{ $description ?? __('site.tagline') }}">
    <meta property="og:type" content="website">
    @if (! empty($jsonLd))
        <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endif
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body { margin: 0; font-family: Georgia, "Iowan Old Style", serif; background: #f5f5f4; color: #1c1917; }
        a { color: inherit; }
        header, footer { background: #0c0a09; color: #fafaf9; }
        .wrap { max-width: 72rem; margin: 0 auto; padding: 1rem 1.25rem; }
    </style>
</head>
<body class="bg-stone-100 text-stone-950 antialiased">
    <a class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:bg-white focus:px-3 focus:py-2" href="#content">{{ __('site.skip') }}</a>
    <header class="border-b border-stone-300 bg-stone-950 text-stone-50">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-4 py-4">
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight">{{ __('site.name') }}</a>
            <nav class="hidden items-center gap-5 text-sm md:flex" aria-label="Primary">
                <a class="underline-offset-4 hover:underline" href="{{ route('catalog') }}">{{ __('site.nav.fabrics') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('machinery') }}">{{ __('site.nav.machinery') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('page', 'quality') }}">{{ __('site.nav.quality') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('page', 'about') }}">{{ __('site.nav.mill') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('news') }}">{{ __('site.nav.news') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('page', 'contact') }}">{{ __('site.nav.contact') }}</a>
            </nav>
            <p class="flex gap-3 text-sm">
                <a class="underline-offset-4 hover:underline" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" hreflang="en">English</a>
                <a class="underline-offset-4 hover:underline" href="{{ request()->fullUrlWithQuery(['lang' => 'bn']) }}" hreflang="bn">বাংলা</a>
            </p>
        </div>
        <details class="border-t border-stone-800 px-4 py-3 md:hidden">
            <summary class="cursor-pointer text-sm">Menu</summary>
            <nav class="mt-3 flex flex-col gap-2 text-sm" aria-label="Mobile">
                <a href="{{ route('catalog') }}">{{ __('site.nav.fabrics') }}</a>
                <a href="{{ route('machinery') }}">{{ __('site.nav.machinery') }}</a>
                <a href="{{ route('page', 'quality') }}">{{ __('site.nav.quality') }}</a>
                <a href="{{ route('page', 'about') }}">{{ __('site.nav.mill') }}</a>
                <a href="{{ route('news') }}">{{ __('site.nav.news') }}</a>
                <a href="{{ route('page', 'contact') }}">{{ __('site.nav.contact') }}</a>
            </nav>
        </details>
    </header>
    <main id="content">
        @yield('content')
    </main>
    <footer class="border-t border-stone-300 bg-stone-950 text-stone-200">
        <div class="mx-auto flex max-w-6xl flex-wrap items-end justify-between gap-4 px-4 py-8 text-sm">
            <div>
                <p class="font-semibold text-stone-50">{{ __('site.name') }}</p>
                <p>Konabari, Gazipur</p>
                <p>{{ app(\App\Support\BanglaDate::class)->label(now()) }}</p>
            </div>
            <p class="flex gap-4">
                <a class="underline-offset-4 hover:underline" href="{{ route('sample') }}">{{ __('site.sample_title') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('careers') }}">{{ __('site.career_title') }}</a>
                <a class="underline-offset-4 hover:underline" href="{{ route('page', 'privacy') }}">{{ __('site.pages.privacy.title') }}</a>
            </p>
        </div>
    </footer>
</body>
</html>
