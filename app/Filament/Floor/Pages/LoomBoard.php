<?php

declare(strict_types=1);

namespace App\Filament\Floor\Pages;

use App\Models\FabricArticle;
use App\Models\LoomProduction;
use App\Models\LoomStoppage;
use App\Models\Machine;
use App\Services\WeavingMath;
use Filament\Pages\Page;

class LoomBoard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Loom board';

    protected static string $view = 'filament.floor.loom-board';

    public static function getRoutePath(): string
    {
        return '/';
    }

    public ?int $loomId = null;

    public ?int $articleId = null;

    public int $picks = 0;

    /** @return array<string, string> */
    public static function reasons(): array
    {
        return [
            'warp_break' => 'টানা ছিঁড়া',
            'weft_break' => 'পড়েন ছিঁড়া',
            'warp_out' => 'টানা শেষ',
            'weft_out' => 'পড়েন শেষ',
            'mechanical' => 'যান্ত্রিক',
            'power' => 'বিদ্যুৎ',
            'style_change' => 'স্টাইল পরিবর্তন',
            'no_operator' => 'অপারেটর নেই',
            'unspecified' => 'কারণ নেই',
        ];
    }

    public function stop(int $loomId, string $reason): void
    {
        LoomStoppage::query()->create([
            'loom_id' => $loomId,
            'reason_code' => $reason,
            'reason_bn' => self::reasons()[$reason] ?? $reason,
            'minutes' => 1,
            'started_at' => now(),
            'source' => 'kiosk',
            'operator_id' => auth()->user()->employee_id,
            'branch_id' => auth()->user()->branch_id,
        ]);
    }

    public function saveProduction(WeavingMath $math): void
    {
        $this->validate([
            'loomId' => ['required', 'integer'],
            'articleId' => ['nullable', 'integer'],
            'picks' => ['required', 'integer', 'min:1'],
        ]);
        $loom = Machine::query()->findOrFail($this->loomId);
        $article = $this->articleId ? FabricArticle::query()->find($this->articleId) : null;
        $rpm = (int) ($loom->rpm ?: 600);
        LoomProduction::query()->create([
            'loom_id' => $loom->id,
            'article_id' => $article?->id,
            'production_date' => now()->toDateString(),
            'picks' => $this->picks,
            'rpm' => $rpm,
            'minutes' => 480,
            'efficiency' => $math->efficiency($this->picks, $rpm, 480),
            'metres' => $math->metresFromPicks($this->picks, (string) ($article->ppi ?? 72)),
            'source' => 'kiosk',
            'operator_id' => auth()->user()->employee_id,
            'branch_id' => auth()->user()->branch_id,
        ]);
        $this->picks = 0;
    }

    protected function getViewData(): array
    {
        return [
            'looms' => Machine::query()->where('machine_type', 'loom')->orderBy('code')->get(),
            'articles' => FabricArticle::query()->orderBy('code')->limit(30)->get(),
            'reasons' => self::reasons(),
        ];
    }
}
