<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CommercialInvoice;
use App\Models\CostSheet;
use App\Models\FabricRoll;
use App\Models\GatePass;
use App\Models\JobworkChallan;
use App\Models\PackingList;
use App\Models\PayrollRun;
use App\Services\DocumentPdfService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    public function __invoke(DocumentPdfService $pdf, string $kind, int $id): Response
    {
        abort_unless(in_array($kind, DocumentPdfService::KINDS, true), 404);
        $record = $this->record($kind, $id);

        return $pdf->download($kind, $record);
    }

    private function record(string $kind, int $id): Model
    {
        $class = match ($kind) {
            'invoice' => CommercialInvoice::class,
            'challan' => JobworkChallan::class,
            'gate-pass' => GatePass::class,
            'inspection' => FabricRoll::class,
            'payslip' => PayrollRun::class,
            'packing-list' => PackingList::class,
            'cost-sheet' => CostSheet::class,
        };

        return $class::query()->findOrFail($id);
    }
}
