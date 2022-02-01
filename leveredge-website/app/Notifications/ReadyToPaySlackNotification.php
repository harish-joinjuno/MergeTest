<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ReadyToPaySlackNotification extends Notification
{
    use Queueable;

    public $type;

    public $claimUrl;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param string $claimUrl
     */
    public function __construct(string $type, string $claimUrl)
    {
        $this->type     = $type;
        $this->claimUrl = $claimUrl;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage())
            ->content($this->type)
            ->attachment(function ($attachment) {
                $attachment->fields([
                    'Claim Url' => $this->claimUrl,
                ]);
            });
    }
}
