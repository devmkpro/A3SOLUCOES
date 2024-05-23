<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    DB::table('tasks')
        ->where('expires_at', '<', now())
        ->where('status', 'pending')
        ->update(['status' => 'expired']);

    DB::table('sub_tasks')
        ->where('expires_at', '<', now())
        ->where('status', 'pending')
        ->update(['status' => 'expired']);
})->everyMinute();