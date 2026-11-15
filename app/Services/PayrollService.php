<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Employee;
use App\Models\LoomProduction;
use App\Models\PayrollLine;
use App\Models\PayrollRun;
use App\Models\WageRate;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class PayrollService
{
    public function pieceRun(Employee $operator, string $period): PayrollRun
    {
        $rate = WageRate::query()->orderByDesc('id')->value('rate') ?? '2.5000';
        $rows = LoomProduction::query()->where('operator_id', $operator->id)->get();
        $metres = BigDecimal::of((string) $rows->sum('metres'));
        $picks = (int) $rows->sum('picks');
        $piece = $metres->multipliedBy((string) $rate)->toScale(2, RoundingMode::HALF_UP);
        $ot = BigDecimal::of('500.00');
        $net = $piece->plus($ot);

        $run = PayrollRun::query()->create([
            'number' => app(NumberSeriesService::class)->next(PayrollRun::class, $operator->branch_id),
            'status' => 'approved',
            'period' => $period,
            'total_net' => (string) $net,
            'branch_id' => $operator->branch_id,
        ]);

        PayrollLine::query()->create([
            'payroll_run_id' => $run->id,
            'employee_id' => $operator->id,
            'piece' => (string) $piece,
            'overtime' => (string) $ot,
            'net' => (string) $net,
            'metres' => (string) $metres->toScale(3, RoundingMode::HALF_UP),
            'picks' => $picks,
            'branch_id' => $operator->branch_id,
        ]);

        return $run;
    }
}
