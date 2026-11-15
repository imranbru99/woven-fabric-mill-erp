<?php

declare(strict_types=1);

return [
    'grade_a_max' => 20,
    'grade_b_max' => 28,
    'grade_c_max' => 40,
    'timezone' => 'Asia/Dhaka',
    'currency' => 'BDT',
    'efficiency_target' => 85,
    'behind_plan_pct' => 10,
    'beam_runout_metres' => 80,
    'legal_ot_minutes_week' => 600,
    'admin_ip_allowlist' => env('ADMIN_IP_ALLOWLIST', ''),
    'turnstile_secret' => env('TURNSTILE_SECRET'),
];
