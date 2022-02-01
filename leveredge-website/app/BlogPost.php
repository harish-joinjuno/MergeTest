<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class BlogPost
 * @package App
 * @property int $id
 * @property int $sort_order
 * @property bool $active
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $video_id
 * @property string $video_thumbnail
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class BlogPost extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];
}
