<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CalendlyNewInviteeCreatedNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->error()
            ->content('New Calendly Invitee Created')
            ->attachment(function ($attachment) {
                $attachment->fields([
                    'Assigned To' => $this->data['payload']['event']['assigned_to'][0],
                    'Start Time'  => $this->data['payload']['event']['start_time_pretty'],
                    'End Time'    => $this->data['payload']['event']['end_time_pretty'],
                    'Location'    => $this->data['payload']['event']['location'],
                ]);
            });
    }
}
