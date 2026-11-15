<?php

namespace App\Providers;

use App\Models\FabricArticle;
use App\Services\WeavingMath;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        FabricArticle::saving(function (FabricArticle $article): void {
            if ((float) $article->epi <= 0 || (float) $article->ppi <= 0 || (float) $article->grey_width_cm <= 0) {
                return;
            }
            $sheet = app(WeavingMath::class)->technicalSheet($article);
            $article->total_ends = $sheet['total_ends'];
            $article->warp_kg_per_100m = $sheet['warp_kg_per_100m'];
            $article->weft_kg_per_100m = $sheet['weft_kg_per_100m'];
            $article->calculated_gsm = $sheet['calculated_gsm'];
            $article->metres_per_loom_shift = $sheet['metres_per_loom_shift'];
        });
    }
}
