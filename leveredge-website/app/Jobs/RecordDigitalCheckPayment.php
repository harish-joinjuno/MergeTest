<?php

namespace App\Jobs;

use App\CompletedCampusAmbassadorTask;
use App\Payment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecordDigitalCheckPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $model;
    public $user;
    public $payer;
    public $digitalCheck;

    public function __construct(Model $model, User $user, User $payer, array $digitalCheck)
    {
        $this->model         = $model;
        $this->user          = $user;
        $this->payer         = $payer;
        $this->digitalCheck  = $digitalCheck;
    }

    public function handle()
    {
        if ($this->model->payment_record_id) {
            return;
        }

        $payment                        = new Payment();
        $payment->user_id               = $this->user->id;
        $payment->payer_id              = $this->payer->id;
        $payment->payment_method_id     = $this->model->payment_method_id;
        $payment->amount                = $this->digitalCheck['amount'];
        $payment->reference_information = $this->digitalCheck;
        $payment->status                = Payment::STATUS_SUBMITTED;
        $payment->save();

        $this->model->refresh();
        $this->model->payment_completed = true;
        $this->model->payment_record_id = $payment->id;
        $this->model->save();
    }
}
