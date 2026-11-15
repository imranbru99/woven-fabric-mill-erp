<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FabricArticle;
use App\Models\Yarn;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

/**
 * Weaving calculations used on the article technical sheet, the loom board and inspection.
 * Yarn length constant: 840 yards per lb of Ne 1 cotton = 1693.54 metres per kg.
 */
class WeavingMath
{
    public const METRES_PER_KG_NE1 = '1693.54';

    public const INCHES_PER_METRE = '39.3700787402';

    public function toNe(string $count, string $system): string
    {
        $value = BigDecimal::of($count);

        return match (strtoupper($system)) {
            'NM' => (string) $value->dividedBy('1.69336', 4, RoundingMode::HALF_UP),
            'TEX' => (string) BigDecimal::of('590.541')->dividedBy($value, 4, RoundingMode::HALF_UP),
            'DENIER', 'D' => (string) BigDecimal::of('5314.87')->dividedBy($value, 4, RoundingMode::HALF_UP),
            default => (string) $value->toScale(4, RoundingMode::HALF_UP),
        };
    }

    public function totalEnds(string $epi, string $widthCm, int $selvedgeEnds = 0): int
    {
        $inches = BigDecimal::of($widthCm)->dividedBy('2.54', 6, RoundingMode::HALF_UP);

        return (int) BigDecimal::of($epi)->multipliedBy($inches)->toScale(0, RoundingMode::HALF_UP)->toInt() + $selvedgeEnds;
    }

    public function yarnKgPer100m(string $lengthFactor, string $ne, string $crimpPct): string
    {
        $crimp = BigDecimal::one()->plus(BigDecimal::of($crimpPct)->dividedBy('100', 6, RoundingMode::HALF_UP));
        $den = BigDecimal::of($ne)->multipliedBy(self::METRES_PER_KG_NE1);

        return (string) BigDecimal::of($lengthFactor)
            ->multipliedBy('100')
            ->multipliedBy($crimp)
            ->dividedBy($den, 4, RoundingMode::HALF_UP);
    }

    /**
     * @return array{total_ends: int, warp_kg_per_100m: string, weft_kg_per_100m: string, calculated_gsm: string, metres_per_loom_shift: string}
     */
    public function technicalSheet(FabricArticle $article, int $rpm = 600, int $shiftMinutes = 480): array
    {
        $warpNe = $this->countOf($article->warpYarn, '40');
        $weftNe = $this->countOf($article->weftYarn, $warpNe);
        $ends = $this->totalEnds((string) $article->epi, (string) $article->grey_width_cm, (int) $article->selvedge_ends);
        $warp = $this->yarnKgPer100m((string) $ends, $warpNe, (string) ($article->crimp_warp_pct ?: 0));
        $picksPerMetre = BigDecimal::of((string) $article->ppi)->multipliedBy(self::INCHES_PER_METRE);
        $weft = $this->yarnKgPer100m(
            (string) $picksPerMetre->multipliedBy(BigDecimal::of((string) $article->grey_width_cm)->dividedBy('100', 6, RoundingMode::HALF_UP)),
            $weftNe,
            (string) ($article->crimp_weft_pct ?: 0),
        );
        $widthM = BigDecimal::of((string) $article->grey_width_cm)->dividedBy('100', 6, RoundingMode::HALF_UP);
        $gramsPerMetre = BigDecimal::of($warp)->plus($weft)->multipliedBy('10');
        $gsm = $widthM->isZero()
            ? BigDecimal::zero()
            : $gramsPerMetre->dividedBy($widthM, 2, RoundingMode::HALF_UP);
        $metres = $this->metresFromPicks(
            (int) round($rpm * $shiftMinutes * ((float) $article->expected_efficiency / 100)),
            (string) $article->ppi,
        );

        return [
            'total_ends' => $ends,
            'warp_kg_per_100m' => $warp,
            'weft_kg_per_100m' => $weft,
            'calculated_gsm' => (string) $gsm,
            'metres_per_loom_shift' => $metres,
        ];
    }

    public function efficiency(int $actualPicks, int $rpm, int $minutes): string
    {
        $theoretical = $rpm * $minutes;
        if ($theoretical <= 0) {
            return '0.00';
        }

        return (string) BigDecimal::of($actualPicks)
            ->multipliedBy('100')
            ->dividedBy((string) $theoretical, 2, RoundingMode::HALF_UP);
    }

    public function metresFromPicks(int $picks, string $ppi): string
    {
        if (BigDecimal::of($ppi)->isZero()) {
            return '0.000';
        }
        $picksPerMetre = BigDecimal::of($ppi)->multipliedBy(self::INCHES_PER_METRE);

        return (string) BigDecimal::of($picks)->dividedBy($picksPerMetre, 3, RoundingMode::HALF_UP);
    }

    public function defectPoints(string $lengthInch, string $system = '4-point'): int
    {
        $length = (float) $lengthInch;
        if ($system === '10-point') {
            return match (true) {
                $length <= 1 => 1,
                $length <= 5 => 3,
                $length <= 10 => 5,
                $length <= 36 => 10,
                default => (int) (10 * ceil($length / 36)),
            };
        }

        return match (true) {
            $length <= 3 => 1,
            $length <= 6 => 2,
            $length <= 9 => 3,
            default => 4,
        };
    }

    public function pointsPerHundredSqYd(string $points, string $lengthM, string $widthCm): string
    {
        $lengthYd = BigDecimal::of($lengthM)->multipliedBy('1.0936133');
        $widthIn = BigDecimal::of($widthCm)->dividedBy('2.54', 6, RoundingMode::HALF_UP);
        $den = $lengthYd->multipliedBy($widthIn);
        if ($den->isZero()) {
            return '0.00';
        }

        return (string) BigDecimal::of($points)->multipliedBy('3600')->dividedBy($den, 2, RoundingMode::HALF_UP);
    }

    public function grade(string $pointsPer100, string $system = '4-point'): string
    {
        $points = (float) $pointsPer100;
        $a = (float) config('mill.grade_a_max', 20);
        $b = (float) config('mill.grade_b_max', 28);
        $c = (float) config('mill.grade_c_max', 40);
        if ($system === '10-point') {
            $a = 20;
            $b = 30;
            $c = 40;
        }

        return match (true) {
            $points <= $a => 'A',
            $points <= $b => 'B',
            $points <= $c => 'C',
            default => 'reject',
        };
    }

    public function metresToYards(string $metres): string
    {
        return (string) BigDecimal::of($metres)->multipliedBy('1.0936133')->toScale(3, RoundingMode::HALF_UP);
    }

    public function kgToLb(string $kg): string
    {
        return (string) BigDecimal::of($kg)->multipliedBy('2.2046226218')->toScale(3, RoundingMode::HALF_UP);
    }

    private function countOf(?Yarn $yarn, string $fallbackNe): string
    {
        if (! $yarn) {
            return $fallbackNe;
        }

        return $this->toNe((string) $yarn->count_value, (string) $yarn->count_system);
    }
}
