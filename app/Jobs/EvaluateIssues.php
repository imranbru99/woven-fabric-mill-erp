<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\IssueEngine;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class EvaluateIssues implements ShouldQueue
{
    use Queueable;

    public function handle(IssueEngine $engine): void
    {
        $engine->evaluate();
    }
}
