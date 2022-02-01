<?php

namespace App;

use App\Events\MarketingEmailTemplateChangeSlug;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @property int         $id
 * @property string      $slug
 * @property string      $name
 * @property string      $subject
 * @property string|null $description
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class MarketingEmailTemplate extends Model
{
    use Slugable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'subject',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($marketingEmailTemplate) {
            $marketingEmailTemplate->slug = Str::slug($marketingEmailTemplate->name);
        });

        static::updating(function ($marketingEmailTemplate) {
            $marketingEmailTemplate->slug = Str::slug($marketingEmailTemplate->name);
        });
    }
}
