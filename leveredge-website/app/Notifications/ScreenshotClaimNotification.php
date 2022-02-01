<?php

namespace App\Notifications;

use App\ScreenshotClaim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ScreenshotClaimNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $screenshotClaim;

    /**
     * Create a new notification instance.
     *
     * @param ScreenshotClaim $screenshotClaim
     */
    public function __construct(ScreenshotClaim $screenshotClaim)
    {
        $this->screenshotClaim = $screenshotClaim;
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
        return (new SlackMessage)
            ->success()
            ->content('New Screenshot Claim submitted')
            ->attachment(function ($attachment) {
                $attachment->fields([
                    'User'           => $this->screenshotClaim->user->name,
                    'Payment Method' => $this->screenshotClaim->paymentMethod->name,
                ]);
            });
    }
}
