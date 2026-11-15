<?php

use App\Services\WeavingMath;

it('converts yarn counts into the English cotton count', function () {
    $math = new WeavingMath;

    expect($math->toNe('40', 'Ne'))->toBe('40.0000')
        ->and($math->toNe('67.7344', 'Nm'))->toBe('40.0000')
        ->and((float) $math->toNe('14.7635', 'Tex'))->toEqualWithDelta(40, 0.01)
        ->and((float) $math->toNe('132.87175', 'Denier'))->toEqualWithDelta(40, 0.01);
});

it('builds the 40x40 133x72 poplin technical sheet', function () {
    $math = new WeavingMath;
    $article = new App\Models\FabricArticle([
        'epi' => 133,
        'ppi' => 72,
        'grey_width_cm' => 160,
        'selvedge_ends' => 0,
        'crimp_warp_pct' => 8,
        'crimp_weft_pct' => 6,
        'expected_efficiency' => 85,
    ]);

    $sheet = $math->technicalSheet($article);

    expect($sheet['total_ends'])->toBe(8378)
        ->and((float) $sheet['calculated_gsm'])->toBeGreaterThan(125)
        ->and((float) $sheet['calculated_gsm'])->toBeLessThan(131)
        ->and((float) $sheet['warp_kg_per_100m'])->toBeGreaterThan(13)
        ->and((float) $sheet['weft_kg_per_100m'])->toBeGreaterThan(6.5);
});

it('calculates loom efficiency, metres and inspection points', function () {
    $math = new WeavingMath;

    expect($math->efficiency(230400, 600, 480))->toBe('80.00')
        ->and($math->defectPoints('2'))->toBe(1)
        ->and($math->defectPoints('4'))->toBe(2)
        ->and($math->defectPoints('8'))->toBe(3)
        ->and($math->defectPoints('12'))->toBe(4)
        ->and($math->defectPoints('4', '10-point'))->toBe(3)
        ->and($math->grade('18'))->toBe('A')
        ->and($math->grade('24'))->toBe('B')
        ->and($math->grade('35'))->toBe('C')
        ->and($math->grade('55'))->toBe('reject');
});
