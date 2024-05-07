<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Billing;
use App\Mail\PaymentReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendPaymentReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send payment reminders for billings close to due date';

    public function handle()
    {
        $today = Carbon::today();
        $billings = Billing::whereDate('jatuh_tempo', '>=', $today)
                           ->whereDate('jatuh_tempo', '<=', $today->addDays(3))
                           ->get();

        foreach ($billings as $billing) {
            Mail::to($billing->customer->email)->send(new PaymentReminder($billing));
        }

        $this->info('Payment reminders sent successfully.');
    }
}
