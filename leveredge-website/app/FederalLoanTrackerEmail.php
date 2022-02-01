<?php

namespace App;

use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use App\Mail\FederalLoanTrackerWelcomeEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

/**
 * Class FederalLoanTrackerEmail
 * @package App
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property int|null $client_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FederalLoanTrackerEmail extends Model
{
    protected static function booted()
    {
        static::created(function ($federalLoanTrackerEmail) {
            $listId = config('services.mailcoach_email.federal_tracker_list_id');
            dispatch(new SyncScholarshipEntrantWithMailcoachJob($federalLoanTrackerEmail, $listId));
            Mail::to($federalLoanTrackerEmail->email)->send(new FederalLoanTrackerWelcomeEmail());
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
