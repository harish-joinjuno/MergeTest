<?php

namespace App\Notifications;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class QuestionFlowValidationSlackNotification extends Notification
{
    use Queueable;

    public $errors;

    public $failed;

    public $inputs;

    public $questionData;

    public $userOrClient;

    public $question;

    /**
     * Create a new notification instance.
     *
     * @param array $errors
     * @param array $failed
     * @param array $inputs
     * @param array $questionData
     * @param $userOrClient
     */
    public function __construct(array $errors, array $failed, array $inputs, array $questionData, $userOrClient)
    {
        $this->errors       = $errors;
        $this->failed       = $failed;
        $this->inputs       = $inputs;
        $this->questionData = $questionData;
        $this->userOrClient = $userOrClient;
    }

    public function via()
    {
        return ['slack'];
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->error()
            ->content('Question flow validation notification')
            ->attachment(function ($attachment) {
                if ($this->userOrClient instanceof User) {
                    $memberLink = url('/nova/resources/user/' . $this->userOrClient->id);
                } else {
                    $memberLink = url('/nova/resources/client/' . $this->userOrClient->id);
                }
                $fields = [
                    'Page Url' => url('/question-flow/' . $this->questionData['question_flow_slug'] . '/' . $this->questionData['question_page_slug']),
                    'User'     => $memberLink,
                ];

                foreach ($this->errors as $field => $message) {
                    $input = isset($this->inputs[$field]) ? $this->inputs[$field] : 'EMPTY';
                    $fields['(field) ' . $field] = "{$message[0]}. Input was: [{$input}]";
                }

                $attachment->fields($fields);
            });
    }
}
