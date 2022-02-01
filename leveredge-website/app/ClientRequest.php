<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class ClientRequest
 * @package App
 * @property int $id
 * @property int $client_id
 * @property string $method
 * @property string $path
 * @property string $query_string
 * @property string $ip
 * @property string $user_agent
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $utm_term
 * @property string $utm_id
 * @property bool $crawler
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $date
 * @property-read Client $client
 */
class ClientRequest extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
