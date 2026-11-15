<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use ImranDev\UnicodePdf\Facades\UnicodePdf;
use Symfony\Component\HttpFoundation\Response;

class DocumentPdfService
{
    /** @var array<int, string> */
    public const KINDS = ['invoice', 'challan', 'gate-pass', 'inspection', 'payslip', 'packing-list', 'cost-sheet'];

    public function html(string $kind, Model $record): string
    {
        return view('pdf.document', [
            'kind' => $kind,
            'record' => $record,
            'title' => __('pdf.'.$kind),
            'rows' => $this->rows($kind, $record),
        ])->render();
    }

    public function download(string $kind, Model $record): Response
    {
        return UnicodePdf::view('pdf.document', [
            'kind' => $kind,
            'record' => $record,
            'title' => __('pdf.'.$kind),
            'rows' => $this->rows($kind, $record),
        ])->locale(app()->getLocale())->download($kind.'-'.$record->getAttribute('number').'.pdf');
    }

    /** @return array<string, string|null> */
    private function rows(string $kind, Model $record): array
    {
        $common = [
            __('pdf.number') => (string) $record->getAttribute('number'),
            __('pdf.date') => (string) ($record->getAttribute('invoice_date') ?? $record->getAttribute('dispatch_date') ?? $record->getAttribute('created_at')),
            __('pdf.status') => (string) $record->getAttribute('status'),
        ];

        return match ($kind) {
            'invoice' => $common + [
                __('pdf.amount') => (string) $record->getAttribute('total'),
            ],
            'payslip' => $common + [
                __('pdf.amount') => (string) $record->getAttribute('total_net'),
            ],
            'cost-sheet' => $common + [
                __('pdf.rate') => (string) $record->getAttribute('quoted_rate'),
            ],
            default => $common + [
                __('pdf.quantity') => (string) ($record->getAttribute('metres') ?? $record->getAttribute('total_metres') ?? $record->getAttribute('length_m') ?? ''),
            ],
        };
    }
}
