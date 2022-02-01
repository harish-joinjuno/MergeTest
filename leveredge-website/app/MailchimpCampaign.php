<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailchimpCampaign
 * @package App
 * @property int $id
 * @property string $campaign_id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MailchimpCampaign extends Model
{
    protected $fillable = [
        'campaign_id',
        'title',
    ];
}
