<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NotFoundSlackNotifications extends Notification
{
    use Queueable;

    public function via()
    {
        return ['slack'];
    }

    public function toSlack()
    {
        return (new SlackMessage)
                ->error()
                ->content('The 404 exception were just thrown')
                ->attachment(function ($attachment) {
                    $fields = [
                        'Request Full URL' => request()->fullUrl(),
                        'Time'             => Carbon::now()->format('Y-m-d H:i:s'),
                        'Host'             => request()->server('HTTP_HOST'),
                        'IP Address'       => request()->ip(),
                    ];

                    if (request()->server('HTTP_REFERER')) {
                        $fields['Referer'] = request()->server('HTTP_REFERER');
                    }
                    $attachment->fields($fields);
                });
    }
}
