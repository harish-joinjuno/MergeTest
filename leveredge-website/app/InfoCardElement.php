<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $icon
 * @property string $description
 * @property string $info_card_type
 * @property int    $info_card_id
 *
 * @property-read $infoCards
 */
class InfoCardElement extends Model
{
    public function infoCards()
    {
        return $this->morphTo('info_card');
    }
}
