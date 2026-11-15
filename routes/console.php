<?php

use App\Jobs\EvaluateIssues;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new EvaluateIssues)->dailyAt('06:00')->timezone('Asia/Dhaka');

Artisan::command('mill:evaluate-issues', function () {
    $opened = app(\App\Services\IssueEngine::class)->evaluate();
    $this->info(count($opened).' issues evaluated.');
})->purpose('Raise factory issues from the seeded rules');
