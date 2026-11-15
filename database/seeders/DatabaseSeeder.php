<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\JobOpening;
use App\Models\Page;
use App\Models\Post;
use App\Services\MillFlow;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! \App\Models\User::query()->where('email', 'owner@mill.test')->exists()) {
            MillFlow::demo();
        }

        if (Page::query()->where('locale', 'en')->exists()) {
            return;
        }

        foreach (['About', 'Leadership', 'Vision', 'Facilities', 'Quality', 'Sustainability', 'Downloads', 'Contact', 'Privacy', 'Terms'] as $title) {
            Page::query()->create([
                'title' => $title,
                'locale' => 'en',
                'body' => __('site.pages.'.strtolower($title).'.body'),
                'meta_title' => $title,
                'meta_description' => __('site.pages.'.strtolower($title).'.description'),
                'is_published' => true,
                'template' => 'page',
            ]);
        }

        Post::query()->create([
            'title' => 'Air-jet shed on a second shift',
            'locale' => 'en',
            'excerpt' => 'Loom 14 and the rest of the air-jet line now run shift A and shift B.',
            'body' => 'The second shift started after the sizing machine held pick-up inside the recipe for a week.',
            'published_at' => now(),
            'is_published' => true,
        ]);

        JobOpening::query()->create([
            'title' => 'Loom operator',
            'description' => 'Air-jet experience, shift A or B, Gazipur.',
            'closes_on' => now()->addMonth()->toDateString(),
            'is_published' => true,
        ]);

        Certificate::query()->create([
            'name' => 'ETP licence',
            'issuer' => 'Department of Environment',
            'issued_on' => now()->subYear()->toDateString(),
            'expires_on' => now()->addMonths(8)->toDateString(),
            'is_public' => true,
        ]);
    }
}
