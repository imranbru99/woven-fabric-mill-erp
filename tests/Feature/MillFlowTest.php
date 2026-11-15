<?php

use App\Models\FabricRoll;
use App\Models\FiscalPeriod;
use App\Models\GatePass;
use App\Models\Issue;
use App\Models\Journal;
use App\Models\StockLot;
use App\Models\YarnLot;
use App\Services\DocumentPdfService;
use App\Services\IssueEngine;
use App\Services\MillFlow;
use App\Services\PostingService;
use App\Services\ReconciliationService;
use App\Services\ReportCatalog;
use App\Services\StockService;
use App\Services\TraceabilityService;
use Brick\Math\BigDecimal;

it('runs a woven order from yarn lot to cash and raises every factory rule', function () {
    $demo = MillFlow::demo();
    $trace = app(TraceabilityService::class)->fromRoll('RL-1401');

    expect($demo['article']->total_ends)->toBe(8378)
        ->and((float) $demo['article']->calculated_gsm)->toBeGreaterThan(125)
        ->and((float) $demo['article']->calculated_gsm)->toBeLessThan(131)
        ->and($trace['warp_lot'])->toBe('WL-19')
        ->and($trace['weft_lot'])->toBe('WF-07')
        ->and($trace['beam'])->toBe('WB-14')
        ->and($trace['loom_id'])->toBe($demo['roll']->loom_id)
        ->and($trace['operator_id'])->toBe($demo['roll']->operator_id)
        ->and($trace['sizing_batch'])->not->toBeNull();

    $books = app(ReconciliationService::class)->snapshot();
    expect($books['balanced'])->toBeTrue()
        ->and($books['production_m'])->toBe($books['inspected_m'])
        ->and($books['inspected_m'])->toBe($books['invoiced_m'])
        ->and($books['accounts']['1200'])->toBe('0.00')
        ->and($books['accounts']['4100'])->toBe('-'.$demo['invoice']->total)
        ->and($books['accounts']['1300'])->toBe('24640.00');

    expect(Journal::query()->get()->every(fn (Journal $journal) => BigDecimal::of((string) $journal->total_debit)->isEqualTo((string) $journal->total_credit)))->toBeTrue();

    $codes = Issue::query()->pluck('rule_code')->unique()->sort()->values()->all();
    expect($codes)->toEqual(collect(IssueEngine::codes())->sort()->values()->all());

    $roll = FabricRoll::query()->where('number', 'RL-1401')->first();
    expect(YarnLot::query()->find($roll->warp_lot_id)->lot_no)->toBe('WL-19')
        ->and(app(ReportCatalog::class)->names())->toHaveCount(101)
        ->and((float) app(ReportCatalog::class)->run('production_metres.all')['total'])->toBeGreaterThan(0)
        ->and(app(DocumentPdfService::class)->html('invoice', $demo['invoice']))->toContain($demo['invoice']->number);

    $pass = GatePass::query()->first();
    test()->actingAs($demo['owner'], 'sanctum')
        ->postJson('/api/loom-monitor/import', ['rows' => [['loom_code' => 'L-14', 'picks' => 1200, 'ppi' => 72]]])
        ->assertOk()
        ->assertJsonPath('imported', 1);
    test()->actingAs($demo['owner'], 'sanctum')
        ->postJson('/api/gate/scan', ['qr_token' => $pass->qr_token])
        ->assertOk()
        ->assertJsonPath('status', 'exited');
});

it('blocks a second yarn lot on the same warp and a locked period', function () {
    $demo = MillFlow::demo();
    $stock = app(StockService::class);
    $first = StockLot::query()->where('lot_no', 'WL-19')->first();
    $other = $stock->receive([
        'item_type' => 'yarn',
        'item_id' => $first->item_id,
        'lot_no' => 'WL-OTHER',
        'warehouse_id' => $first->warehouse_id,
        'qty' => '5',
        'unit_cost' => '220',
        'status' => 'released',
        'branch_id' => $demo['branch']->id,
    ]);

    expect(fn () => $stock->issue($other, '1', ['job_card_id' => $demo['roll']->job_card_id]))
        ->toThrow(RuntimeException::class, 'Lot mixing');

    FiscalPeriod::query()->update(['is_locked' => true]);

    expect(fn () => app(PostingService::class)->post($demo['invoice'], [
        ['account_id' => $demo['accounts']['1000'], 'debit' => '1.00'],
        ['account_id' => $demo['accounts']['3000'], 'credit' => '1.00'],
    ], ['purpose' => 'locked-check', 'branch_id' => $demo['branch']->id]))
        ->toThrow(RuntimeException::class, 'locked');
});
