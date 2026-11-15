<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\FabricArticle;
use App\Models\Machine;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    /** @var array<int, string> */
    public const PAGES = [
        'about', 'leadership', 'vision', 'facilities', 'quality',
        'sustainability', 'downloads', 'contact', 'privacy', 'terms',
    ];

    public function home(): View
    {
        return view('site.home', [
            'stats' => [
                'looms' => $this->count('machines', ['machine_type' => 'loom']),
                'capacity' => $this->sum('machines', 'rpm', ['machine_type' => 'loom']),
                'articles' => $this->count('fabric_articles', ['is_public' => 1]),
                'markets' => $this->count('parties', ['type' => 'buyer']),
            ],
            'articles' => $this->articles()->take(6),
        ]);
    }

    public function page(string $slug): View
    {
        abort_unless(in_array($slug, self::PAGES, true), 404);
        $cms = $this->cms($slug);

        return view('site.page', [
            'slug' => $slug,
            'title' => $cms?->title ?: __('site.pages.'.$slug.'.title'),
            'body' => $cms?->body ?: __('site.pages.'.$slug.'.body'),
            'description' => $cms?->meta_description ?: __('site.pages.'.$slug.'.description'),
            'certificates' => $slug === 'sustainability' ? $this->certificates() : collect(),
        ]);
    }

    public function machinery(): View
    {
        $machines = Schema::hasTable('machines')
            ? Machine::query()->where('is_public', true)->orderBy('code')->get()
            : collect();

        return view('site.machinery', ['machines' => $machines]);
    }

    public function catalog(): View
    {
        return view('site.catalog', ['articles' => $this->articles()]);
    }

    public function fabric(string $slug): View
    {
        $article = FabricArticle::query()->where('is_public', true)->where('slug', $slug)->firstOrFail();

        return view('site.fabric', ['article' => $article]);
    }

    public function news(): View
    {
        $posts = Schema::hasTable('posts')
            ? Post::query()->where('is_published', true)->orderByDesc('published_at')->get()
            : collect();

        return view('site.news', ['posts' => $posts]);
    }

    public function sample(): View
    {
        return view('site.form', ['form' => 'sample', 'title' => __('site.sample_title')]);
    }

    public function rfq(): View
    {
        return view('site.form', ['form' => 'rfq', 'title' => __('site.rfq_title')]);
    }

    public function careers(): View
    {
        return view('site.form', ['form' => 'career', 'title' => __('site.career_title')]);
    }

    public function sitemap(): Response
    {
        $urls = [url('/')];
        foreach (self::PAGES as $slug) {
            $urls[] = url('/'.$slug);
        }
        foreach (['machinery', 'fabrics', 'quality', 'news', 'sample-request', 'rfq', 'careers', 'contact'] as $path) {
            if (! in_array(url('/'.$path), $urls, true)) {
                $urls[] = url('/'.$path);
            }
        }
        foreach ($this->articles() as $article) {
            $urls[] = url('/fabrics/'.$article->slug);
        }

        return response()->view('site.sitemap', ['urls' => array_values(array_unique($urls))])->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $body = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /buyer\nDisallow: /supplier\nDisallow: /floor\nSitemap: ".url('/sitemap.xml')."\n";

        return response($body, 200, ['Content-Type' => 'text/plain']);
    }

    private function cms(string $slug): ?Page
    {
        if (! Schema::hasTable('pages')) {
            return null;
        }

        return Page::query()->where('slug', $slug)->where('locale', app()->getLocale())->where('is_published', true)->first()
            ?? Page::query()->where('slug', $slug)->where('is_published', true)->first();
    }

    private function articles()
    {
        if (! Schema::hasTable('fabric_articles')) {
            return collect();
        }

        return FabricArticle::query()->where('is_public', true)->orderBy('code')->get();
    }

    private function certificates()
    {
        if (! Schema::hasTable('certificates')) {
            return collect();
        }

        return Certificate::query()->where('is_public', true)->orderBy('name')->get();
    }

    private function count(string $table, array $where = []): int
    {
        if (! Schema::hasTable($table)) {
            return 0;
        }
        $query = \Illuminate\Support\Facades\DB::table($table)->where($where);
        if (Schema::hasColumn($table, 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return (int) $query->count();
    }

    private function sum(string $table, string $column, array $where = []): int
    {
        if (! Schema::hasTable($table)) {
            return 0;
        }
        $query = \Illuminate\Support\Facades\DB::table($table)->where($where);
        if (Schema::hasColumn($table, 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return (int) $query->sum($column);
    }
}
