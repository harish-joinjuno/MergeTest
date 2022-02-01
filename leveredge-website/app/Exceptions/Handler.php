<?php

namespace App\Exceptions;

use App\Notifications\NotFoundSlackNotifications;
use App\PageNotFoundError;
use App\PageNotFoundErrorException;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        if ($exception instanceof ModelNotFoundException) {
            if (!PageNotFoundErrorException::where('url','like',request()->fullUrl())->exists()) {
                $referer  = '';
                $slackUrl = config('services.slack.webhook_url');

                if (request()->server('HTTP_REFERER')) {
                    $referer  = request()->server('HTTP_REFERER');
                    $slackUrl = config('services.slack.404_with_referrers');
                }

                Notification::route('slack', $slackUrl)
                    ->notify(new NotFoundSlackNotifications());

                $pageNotFoundError              = new PageNotFoundError();
                $pageNotFoundError->url         = substr(request()->fullUrl(), 0, 65535);
                $pageNotFoundError->referer     = $referer ? substr($referer, 0 , 65535) : 'No referer';
                $pageNotFoundError->host        = request()->server('HTTP_HOST');
                $pageNotFoundError->ip_address  = request()->ip();
                $pageNotFoundError->save();
            }
        }
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
