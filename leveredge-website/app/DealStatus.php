<?php

namespace App;

use App\Traits\Slugable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $loan_status
 * @property string $slug
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class DealStatus extends Model
{
    const CLICKED_TO_PROVIDER_ID         = 1;
    const STARTED_APPLICATION            = 2;
    const RECEIVED_PRELIMINARY_QUOTES_ID = 4;
    const SUBMITTED_COMPLETE_APPLICATION = 5;
    const APPROVED_BY_LENDER             = 6;
    const RECEIVED_QUOTES_ID             = 7;
    const SIGNED_THE_LOAN                = 8;
    const REJECTED_BY_LENDER             = 9;
    const WITHDRAWN_BY_LENDER            = 11;
    const DOCUMENT_SUBMITTED             = 12;
    const CERTIFIED                      = 13;
    const DEFAULT_DEAL_STATUS_ID         = DealStatus::CLICKED_TO_PROVIDER_ID;

    use SoftDeletes,
        Slugable;

    protected $fillable = [
        'loan_status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($dealStatus) {
            $dealStatus->slug = Str::slug($dealStatus->loan_status);
        });
    }

    public function deals()
    {
        return $this->belongsToMany(Deal::class, 'deal_status_applicabilities');
    }
}
