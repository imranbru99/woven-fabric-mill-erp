<?php

use App\Support\BanglaDate;
use Illuminate\Support\Carbon;

it('labels 14 April 2026 as the first of Boishakh 1433', function () {
    $bangla = (new BanglaDate)->convert(Carbon::parse('2026-04-14'));

    expect($bangla['day'])->toBe(1)
        ->and($bangla['month'])->toBe(1)
        ->and($bangla['year'])->toBe(1433)
        ->and($bangla['label'])->toBe('১ বৈশাখ ১৪৩৩');
});
