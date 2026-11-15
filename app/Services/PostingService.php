<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FiscalPeriod;
use App\Models\Journal;
use App\Models\JournalLine;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PostingService
{
    /**
     * Post a balanced journal. Modules must not write journal lines themselves.
     *
     * @param  array<int, array{account_id: int, debit?: numeric-string|int|float, credit?: numeric-string|int|float, cost_centre_id?: int|null, narration?: string|null, currency_code?: string, fx_rate?: numeric-string|int|float}>  $lines
     */
    public function post(Model $source, array $lines, array $options = []): Journal
    {
        return DB::transaction(function () use ($source, $lines, $options): Journal {
            $purpose = (string) ($options['purpose'] ?? 'post');
            $existing = Journal::query()
                ->where('source_type', $source::class)
                ->where('source_id', $source->getKey())
                ->where('purpose', $purpose)
                ->first();

            if ($existing && empty($options['force'])) {
                return $existing;
            }

            $date = $options['date'] ?? now()->toDateString();
            $this->assertPeriodOpen((string) $date, $options['branch_id'] ?? $source->getAttribute('branch_id'));

            $debit = BigDecimal::zero();
            $credit = BigDecimal::zero();
            $normalized = [];

            foreach ($lines as $line) {
                $d = BigDecimal::of((string) ($line['debit'] ?? 0))->toScale(2, RoundingMode::HALF_UP);
                $c = BigDecimal::of((string) ($line['credit'] ?? 0))->toScale(2, RoundingMode::HALF_UP);
                if ($d->isPositive() && $c->isPositive()) {
                    throw new RuntimeException('A journal line cannot carry both a debit and a credit.');
                }
                if ($d->isZero() && $c->isZero()) {
                    continue;
                }
                $debit = $debit->plus($d);
                $credit = $credit->plus($c);
                $normalized[] = [
                    'account_id' => $line['account_id'],
                    'cost_centre_id' => $line['cost_centre_id'] ?? null,
                    'debit' => (string) $d,
                    'credit' => (string) $c,
                    'narration' => $line['narration'] ?? null,
                    'currency_code' => $line['currency_code'] ?? ($options['currency_code'] ?? 'BDT'),
                    'fx_rate' => (string) ($line['fx_rate'] ?? 1),
                ];
            }

            if ($normalized === [] || ! $debit->isEqualTo($credit)) {
                throw new RuntimeException('Journal is not balanced. Debit '.$debit.' credit '.$credit.'.');
            }

            $journal = Journal::query()->create([
                'number' => app(NumberSeriesService::class)->next(Journal::class, $options['branch_id'] ?? null),
                'journal_date' => $date,
                'branch_id' => $options['branch_id'] ?? $source->getAttribute('branch_id'),
                'source_type' => $source::class,
                'source_id' => $source->getKey(),
                'purpose' => $purpose,
                'narration' => $options['narration'] ?? class_basename($source).' '.$source->getAttribute('number'),
                'status' => 'posted',
                'currency_code' => $options['currency_code'] ?? 'BDT',
                'total_debit' => (string) $debit,
                'total_credit' => (string) $credit,
            ]);

            foreach ($normalized as $line) {
                JournalLine::query()->create(['journal_id' => $journal->id, ...$line, 'branch_id' => $journal->branch_id]);
            }

            return $journal->load('journalLines');
        });
    }

    public function assertPeriodOpen(string $date, mixed $branchId = null): void
    {
        $locked = FiscalPeriod::query()
            ->where('is_locked', true)
            ->whereDate('starts_on', '<=', $date)
            ->whereDate('ends_on', '>=', $date)
            ->when($branchId, fn ($q) => $q->where(function ($inner) use ($branchId): void {
                $inner->where('branch_id', $branchId)->orWhereNull('branch_id');
            }))
            ->exists();

        if ($locked) {
            throw new RuntimeException('Fiscal period is locked for '.$date.'.');
        }
    }
}
