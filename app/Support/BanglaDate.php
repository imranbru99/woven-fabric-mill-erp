<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

/**
 * Bangladesh revised Bangla calendar. Boishakh begins on 14 April.
 * 14 April 2026 is 1 Boishakh 1433.
 */
class BanglaDate
{
    /** @var array<int, string> */
    public const MONTHS = [
        'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন',
        'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র',
    ];

    /** @return array{day: int, month: int, year: int, label: string} */
    public function convert(CarbonInterface $date): array
    {
        $onOrAfterNewYear = $date->month > 4 || ($date->month === 4 && $date->day >= 14);
        $year = $date->year - ($onOrAfterNewYear ? 593 : 594);
        $startYear = $onOrAfterNewYear ? $date->year : $date->year - 1;
        $start = Carbon::create($startYear, 4, 14)->startOfDay();
        $elapsed = (int) $start->diffInDays($date->copy()->startOfDay());

        $lengths = [31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30, 30];
        if (Carbon::create($startYear + 1, 1, 1)->isLeapYear()) {
            $lengths[10] = 31;
        }

        $month = 0;
        $day = $elapsed + 1;
        while ($month < 11 && $day > $lengths[$month]) {
            $day -= $lengths[$month];
            $month++;
        }

        return [
            'day' => $day,
            'month' => $month + 1,
            'year' => $year,
            'label' => $this->digits($day).' '.self::MONTHS[$month].' '.$this->digits($year),
        ];
    }

    public function label(CarbonInterface $date): string
    {
        return $this->convert($date)['label'];
    }

    private function digits(int $number): string
    {
        return strtr((string) $number, ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯']);
    }
}
