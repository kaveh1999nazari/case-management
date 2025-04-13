<?php

use App\Console\Commands\CancelUnpaidOrders;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::Command(CancelUnpaidOrders::class)
        ->everyMinute();

