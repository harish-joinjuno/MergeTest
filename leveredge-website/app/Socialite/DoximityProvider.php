<?php


namespace App\Socialite;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Jose\Factory\JWKFactory;
use Jose\Loader;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class DoximityProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopeSeparator = ' ';

    protected $scopes = [
        'basic','openid',
    ];

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.doximity.auth_url'), $state);
    }

    protected function getTokenUrl()
    {
        return config('services.doximity.token_url');
    }

    protected function getTokenFields($code): array
    {
        return [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => $this->redirectUrl,
            'code_verifier' => $this->request->session()->pull('code_verifier'),
        ];
    }

    public function getAccessTokenResponse($code)
    {
        try {
            $response = $this->getHttpClient()->post($this->getTokenUrl(), [
                'headers'     => [
                    'Accept'        => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                ],
                'form_params' => $this->getTokenFields($code),
            ]);

            return json_decode($response->getBody(), true);
        } catch (BadResponseException $e) {
            return redirect()->to('/login');
        }
    }

    protected function getCodeFields($state = null): array
    {
        $this->request->session()->put('code_verifier', $codeVerifier = Str::random(40));
        $fields = [
            'client_id'             => $this->clientId,
            'redirect_uri'          => $this->redirectUrl,
            'scope'                 => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
            'response_type'         => 'code',
            'type'                  => 'verify',
            'code_challenge'        => $this->base64UrlSafe(hash('sha256', $codeVerifier)),
            'code_challenge_method' => 'S256',
        ];

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        return array_merge($fields, $this->parameters);
    }

    public function user()
    {
        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        $jwksResponse = $this->getHttpClient()->get(config('services.doximity.jwt_token_verify_url'));

        $decoded = JWT::decode($response['id_token'], JWK::parseKeySet(json_decode($jwksResponse->getBody(),true)), ['RS256']);

        $user = $this->mapUserToObject($this->getUserByToken(
            $token = Arr::get($response, 'access_token')
        ));

        return $user->setToken($token)
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'));
    }

    protected function getUserByToken($token): array
    {
        $userUrl = 'https://www.doximity.com/api/v1/users/current';

        try {
            $response = $this->getHttpClient()->get(
                $userUrl, $this->getRequestOptions($token)
            );

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            dd($e->getMessage(), $token);
        }
    }

    protected function mapUserToObject(array $user): \Laravel\Socialite\Two\User
    {
        return (new User)->setRaw($user)->map([
            'name'            => $user['name'] ?? null,
            'email'           => $user['email'] ?? null,
            'first_name'      => $user['first_name'],
            'last_name'       => $user['last_name'],
        ]);
    }

    protected function getRequestOptions($token): array
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ];
    }

    private function base64UrlSafe($input): string
    {
        return rtrim(strtr(base64_encode(pack('H*', $input)), "+/", "-_"), "=");
    }
}
