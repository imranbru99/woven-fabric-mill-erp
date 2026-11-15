<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Models\CommercialInvoiceLine;
use App\Models\FabricRoll;
use App\Models\JournalLine;
use App\Models\LoomProduction;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class ReconciliationService
{
    /** @return array{balanced: bool, production_m: string, inspected_m: string, invoiced_m: string, accounts: array<string, string>} */
    public function snapshot(): array
    {
        $balanced = true;
        $byAccount = [];
        foreach (JournalLine::query()->get() as $line) {
            $byAccount[$line->account_id]['debit'] = ($byAccount[$line->account_id]['debit'] ?? BigDecimal::zero())->plus((string) $line->debit);
            $byAccount[$line->account_id]['credit'] = ($byAccount[$line->account_id]['credit'] ?? BigDecimal::zero())->plus((string) $line->credit);
        }

        $debit = BigDecimal::zero();
        $credit = BigDecimal::zero();
        $named = [];
        foreach (Account::query()->get() as $account) {
            $d = $byAccount[$account->id]['debit'] ?? BigDecimal::zero();
            $c = $byAccount[$account->id]['credit'] ?? BigDecimal::zero();
            $debit = $debit->plus($d);
            $credit = $credit->plus($c);
            $named[$account->code] = (string) $d->minus($c)->toScale(2, RoundingMode::HALF_UP);
        }
        if (! $debit->isEqualTo($credit)) {
            $balanced = false;
        }

        return [
            'balanced' => $balanced,
            'production_m' => (string) BigDecimal::of((string) LoomProduction::query()->sum('metres'))->toScale(3, RoundingMode::HALF_UP),
            'inspected_m' => (string) BigDecimal::of((string) FabricRoll::query()->sum('length_m'))->toScale(3, RoundingMode::HALF_UP),
            'invoiced_m' => (string) BigDecimal::of((string) CommercialInvoiceLine::query()->sum('quantity'))->toScale(3, RoundingMode::HALF_UP),
            'accounts' => $named,
        ];
    }
}
