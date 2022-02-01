<?php

namespace App\Notifications;

use App\LeveredgeRewardClaim;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class RewardClaimNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $rewardClaim;

    /**
     * Create a new notification instance.
     *
     * @param $rewardClaim
     */
    public function __construct($rewardClaim)
    {
        $this->rewardClaim = $rewardClaim;
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
            ->content('New Leveredge Reward Claim submitted')
            ->attachment(function ($attachment) {
                $attachment->fields([
                    'User'           => $this->rewardClaim->user->name,
                    'Deal'           => $this->rewardClaim->deal->name,
                    'Payment Method' => $this->rewardClaim->paymentMethod->name,
                    'Reward Amount'  => $this->rewardClaim->reward_amount,
                ]);
            });
    }
}
