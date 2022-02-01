<?php


namespace App\Traits;

trait Slugable
{
    public function setSlugAttribute($value)
    {
        $slug = $value;
        if (static::whereSlug($value)->exists()) {
            $slug = $this->incrementSlug($value);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug)
    {
        $original = $slug;
        $count    = 2;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count ++;
        }

        return $slug;
    }
}
