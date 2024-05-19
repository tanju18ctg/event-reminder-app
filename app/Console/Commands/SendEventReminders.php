<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderMail;
use App\Models\Event;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'send:event-reminders';
    protected $description = 'Send email reminders for upcoming events';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $events = Event::where('event_date', '>=', Carbon::now()->format('Y-m-d'))
                       ->where('event_date', '<', Carbon::now()->addDay()->format('Y-m-d'))
                       ->get();

        foreach ($events as $event) {
            $notifyEmails = $event->notify_emails;
            foreach ($notifyEmails as $email) {
                Mail::to($email)->send(new EventReminderMail($event));
            }
        }

        $this->info('Event reminders sent successfully.');
    }
}
