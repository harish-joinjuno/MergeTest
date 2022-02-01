<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SlackLeadSignupNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
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
     * Get the mail representation of the notification.
     *
     * @param SlackMessage
     * @return SlackMessage
     */
    public function toSlack()
    {
        return (new SlackMessage())
            ->content('New Facebook Lead Signup')
            ->attachment(function ($attachment) {
                $attachment->fields([
                    'Citizenship Status' => $this->data['citizenship_status'],
                    'Credit Score'       => $this->data['credit_score'],
                    'Is Medical'         => $this->data['is_medical'],
                    'Email'              => $this->data['email'],
                    'Full Name'          => $this->data['name'],
                ]);
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
