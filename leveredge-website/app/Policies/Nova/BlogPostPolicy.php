<?php


namespace App\Policies\Nova;

use App\BlogPost;

class BlogPostPolicy extends AbstractNovaPermissionHandler
{
    public $resource = BlogPost::class;
}
