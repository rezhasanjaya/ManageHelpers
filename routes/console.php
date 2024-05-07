<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('reminders:send', function () {
    $this->call('reminders:send');
})->describe('Send payment reminders for billings close to due date');

// Registering a schedule for the command
Schedule::command('reminders:send')->daily()->when(function () {
    Log::info('Check if reminders:send is due');
    return true;
});