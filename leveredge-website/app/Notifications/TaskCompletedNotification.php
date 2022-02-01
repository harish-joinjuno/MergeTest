<?php

namespace App\Notifications;

use App\CompletedCampusAmbassadorTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $completedTask;

    public function __construct(CompletedCampusAmbassadorTask $completedTask)
    {
        $this->completedTask = $completedTask;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Campus Ambassador - Completed Task')
            ->markdown('emails.ambassador.completed_task', ['task' => $this->completedTask]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
