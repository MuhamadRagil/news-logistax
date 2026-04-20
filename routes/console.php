<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment('Keep building.');
})->purpose('Display an inspiring quote');

Schedule::command('articles:publish-scheduled')->everyMinute();
