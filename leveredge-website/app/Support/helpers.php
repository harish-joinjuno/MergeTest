<?php

use App\User;
use App\UserProfile;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('user')) {
    function user(): ?User
    {
        if (!auth()->check()) {
            return null;
        }

        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}

if (! function_exists('userProfile')) {
    function userProfile(): ?UserProfile
    {
        return (optional(user())->profile);
    }
}

if (!function_exists('remove_mask')) {
    function remove_mask($value, $default = null, $pattern = '/\D/')
    {
        if (!trim($value)) {
            return $default;
        }

        return preg_replace($pattern, "", $value);
    }
}

if (!function_exists('format_phone_number_us')) {
    function format_phone_number_us(?string $value)
    {
        if (!$value && !trim($value)) {
            return null;
        }

        $clean = remove_mask($value);

        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $clean);
    }
}

if (!function_exists('format_phone_number_iso')) {
    function format_phone_number_iso(?string $value, string $countryCode = "+1")
    {
        if (!$value && !trim($value)) {
            return null;
        }

        $clean = remove_mask($value);

        return "{$countryCode}{$clean}";
    }
}

if (!function_exists('money')) {
    function money($value, $decimal = 2)
    {
        return number_format($value, $decimal, '.', ',');
    }
}

if (!function_exists('timezones')) {
    function timezones()
    {
        return [
            'Pacific/Honolulu'      => 'Hawaii Time',
            'America/Anchorage'     => 'Alaska Time',
            'America/Los_Angeles'   => 'Pacific Time - US & Canada',
            'America/Denver'        => 'Mountain Time - US & Canada',
            'America/Phoenix'       => 'Arizona Time',
            'America/Dawson_Creek'  => 'Dawson Creek Time',
            'America/Chicago'       => 'Central Time - US & Canada',
            'America/New_York'      => 'Eastern Time - US & Canada',
            'America/Coral_Harbour' => 'Coral Harbour Time',
            'America/Halifax'       => 'Atlantic Time',
            'America/Blanc-Sablon'  => 'Blanc-Sablon Time',
            'America/St_Johns'      => 'Newfoundland Time',
        ];
    }
}

if (!function_exists('isSqlite')) {
    function isSqlite()
    {
        $default = config('database.default');
        $key     = "database.connections.{$default}.driver";

        return config($key) === 'sqlite';
    }
}

if (!function_exists('active')) {
    function active($routes, string $class)
    {
        return request()->routeIs($routes) ? $class : '';
    }
}

if (!function_exists('storage_public_url')) {
    function storage_public_url(string $path)
    {
        return Storage::disk(config('filesystems.nova_public_disk'))->url($path);
    }
}

if (!function_exists('toSql')) {
    function toSql($query)
    {
        $bindings = $query->getBindings();

        return preg_replace_callback('/\?/', function () use (&$bindings, $query) {
            return $query->getConnection()->getPdo()->quote(array_shift($bindings));
        }, $query->toSql());
    }
}

function twilioCallback()
{
    if (!app()->environment('local')) {
        return route('webhook.twilio');
    }

    $client   = new Client([
        'http_errors' => false,
    ]);
    $response = $client->get('http://127.0.0.1:4040/api/tunnels');
    if ($response->getStatusCode() != 200) {
        return route('webhook.twilio');
    }

    $contents = $response->getBody()->getContents();
    $data     = json_decode($contents, true);
    $addr     = $data['tunnels'][0]['config']['addr'];
    $addr     = str_replace("https://", "", $addr);
    if (strpos($addr, config('app.url')) != -1) {
        $twilioWebhook = route('webhook.twilio', [], false);

        return "{$data['tunnels'][0]['public_url']}{$twilioWebhook}";
    }

    return route('webhook.twilio');
}


if (! function_exists('addUtmCodes')) {
    function addUtmCodes($url, $object)
    {
        $utm_parameters = [
            'utm_source',
            'utm_campaign',
            'utm_medium',
            'utm_term',
            'utm_content',
            'utm_id',
            'gclid',
        ];

        // Returns a string if the URL has parameters or NULL if not
        $query = parse_url($url, PHP_URL_QUERY);

        // Start the utm query with appropriate prefix
        $utm_query           = '';
        $existingQueryParams = [];
        if ($query) {
            foreach (explode('&', $query) as $queryParam) {
                list($param, $value)         = explode('=', $queryParam);
                $existingQueryParams[$param] = $value;
            }
        } else {
            $utm_query = '?';
        }

        // Add our Utm Parameters
        foreach ($utm_parameters as $parameter) {
            if ( isset($object->$parameter) ) {
                $existingQueryParams[$parameter] = $object->$parameter;
            }
        }

        // return
        return str_replace($query, '', $url) . $utm_query . http_build_query($existingQueryParams);
    }
}

if (! function_exists('redirectWithQueryParams')) {
    function redirectWithQueryParams(string $path = '/', $queryParams = null)
    {
        $queryParams = $queryParams ?: request()->getQueryString();

        $url = url($path) . '?' . $queryParams;

        return redirect()->to($url);
    }
}

if (! function_exists('number_format_with_sign')) {
    function number_format_with_sign($number,$decimals = 0)
    {
        if (is_numeric($number)) {
            if ($number > 0) {
                return '+' . number_format($number, $decimals);
            }

            return number_format($number, $decimals);
        }

        return 'NaN';
    }
}

if (! function_exists('checkForRefiAd')) {
    function checkForRefiAd(\Illuminate\Http\Request $request)
    {
        return $request->get('utm_source') === 'facebook' ||
            ($request->get('utm_source') === 'google' && Str::startsWith($request->get('utm_campaign'),'NonBrand'));
    }
}

if (! function_exists('getClientId')) {
    function getClientId()
    {
        if (\Illuminate\Support\Facades\Cookie::has('client_id')) {
            return \Illuminate\Support\Facades\Cookie::get('client_id');
        }

        $cookies =  \Illuminate\Support\Facades\Cookie::getQueuedCookies();
        /** @var \Symfony\Component\HttpFoundation\Cookie $cookie */
        foreach ($cookies as $cookie) {
            if ($cookie->getName() == "client_id") {
                return $cookie->getValue();
            }
        }

        throw new Exception('Middleware is not queueing a cookie when cookie is not already set');
    }
}

if (! function_exists('getClientIds')) {
    function getClientIds()
    {
        $clientId   = getClientId();
        $userClient = \App\UserClient::where('client_id',$clientId)->first();

        if ($userClient) {
            return \App\UserClient::where('user_id',$userClient->user_id)->pluck('client_id');
        }

        return [$clientId];
    }
}

if (! function_exists('getClient')) {
    /**
     * @return \App\Client
     */
    function getClient()
    {
        return \App\Client::find(getClientId());
    }
}
