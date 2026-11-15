<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FabricArticle;
use App\Models\GatePass;
use App\Models\LoomProduction;
use App\Models\LoomStoppage;
use App\Models\Machine;
use App\Models\Party;
use App\Models\SalesOrder;
use App\Services\StockService;
use App\Services\WeavingMath;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MillApiController extends Controller
{
    public function production(Request $request, WeavingMath $math): JsonResponse
    {
        $data = $request->validate([
            'loom_id' => ['required', 'integer'],
            'article_id' => ['nullable', 'integer'],
            'picks' => ['required', 'integer', 'min:0'],
            'minutes' => ['nullable', 'integer', 'min:1'],
            'rpm' => ['nullable', 'integer', 'min:1'],
        ]);
        $loom = Machine::query()->findOrFail($data['loom_id']);
        $article = isset($data['article_id']) ? FabricArticle::query()->find($data['article_id']) : null;
        $rpm = (int) ($data['rpm'] ?? $loom->rpm ?: 600);
        $minutes = (int) ($data['minutes'] ?? 480);
        $ppi = (string) ($article->ppi ?? 72);
        $row = LoomProduction::query()->create([
            'loom_id' => $loom->id,
            'article_id' => $article?->id,
            'production_date' => now()->toDateString(),
            'picks' => $data['picks'],
            'rpm' => $rpm,
            'minutes' => $minutes,
            'efficiency' => $math->efficiency((int) $data['picks'], $rpm, $minutes),
            'metres' => $math->metresFromPicks((int) $data['picks'], $ppi),
            'source' => 'api',
            'operator_id' => $request->user()->employee_id,
            'branch_id' => $request->user()->branch_id,
        ]);

        return response()->json($row, 201);
    }

    public function stoppage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'loom_id' => ['required', 'integer'],
            'reason_code' => ['required', 'string', 'max:40'],
            'minutes' => ['required', 'integer', 'min:1'],
            'reason_bn' => ['nullable', 'string', 'max:80'],
        ]);
        $row = LoomStoppage::query()->create([
            ...$data,
            'started_at' => now(),
            'source' => 'api',
            'operator_id' => $request->user()->employee_id,
            'branch_id' => $request->user()->branch_id,
        ]);

        return response()->json($row, 201);
    }

    public function gate(Request $request): JsonResponse
    {
        $data = $request->validate(['qr_token' => ['required', 'string']]);
        $pass = GatePass::query()->where('qr_token', $data['qr_token'])->firstOrFail();
        $pass->update(['status' => 'exited']);

        return response()->json(['number' => $pass->number, 'status' => $pass->status, 'vehicle_no' => $pass->vehicle_no]);
    }

    public function receive(Request $request, StockService $stock): JsonResponse
    {
        $data = $request->validate([
            'item_type' => ['required', 'string'],
            'item_id' => ['required', 'integer'],
            'lot_no' => ['required', 'string'],
            'qty' => ['required', 'numeric'],
            'unit_cost' => ['required', 'numeric'],
            'warehouse_id' => ['nullable', 'integer'],
        ]);
        $lot = $stock->receive([
            ...$data,
            'status' => 'quarantine',
            'branch_id' => $request->user()->branch_id,
        ]);

        return response()->json(['id' => $lot->id, 'lot_no' => $lot->lot_no, 'status' => $lot->status], 201);
    }

    public function buyerOrders(Request $request): JsonResponse
    {
        $party = Party::query()->where('email', $request->user()->email)->where('type', 'buyer')->first();
        $orders = SalesOrder::query()
            ->when($party, fn ($q) => $q->where('buyer_id', $party->id))
            ->when(! $party && ! $request->user()->hasAnyRole(['owner', 'merchandiser']), fn ($q) => $q->whereRaw('1 = 0'))
            ->latest('id')
            ->limit(50)
            ->get(['id', 'number', 'status', 'delivery_date', 'total']);

        return response()->json($orders);
    }

    public function loomMonitor(Request $request, WeavingMath $math): JsonResponse
    {
        $data = $request->validate([
            'rows' => ['required', 'array', 'min:1'],
            'rows.*.loom_code' => ['required', 'string'],
            'rows.*.picks' => ['required', 'integer', 'min:0'],
            'rows.*.ppi' => ['nullable', 'numeric'],
            'rows.*.date' => ['nullable', 'date'],
        ]);
        $created = [];
        foreach ($data['rows'] as $row) {
            $loom = Machine::query()->where('code', $row['loom_code'])->first();
            if (! $loom) {
                continue;
            }
            $rpm = (int) ($loom->rpm ?: 600);
            $created[] = LoomProduction::query()->create([
                'loom_id' => $loom->id,
                'production_date' => $row['date'] ?? now()->toDateString(),
                'picks' => $row['picks'],
                'rpm' => $rpm,
                'minutes' => 480,
                'efficiency' => $math->efficiency((int) $row['picks'], $rpm, 480),
                'metres' => $math->metresFromPicks((int) $row['picks'], (string) ($row['ppi'] ?? 72)),
                'source' => 'monitor',
                'branch_id' => $loom->branch_id,
            ])->id;
        }

        return response()->json(['imported' => count($created), 'ids' => $created]);
    }
}
