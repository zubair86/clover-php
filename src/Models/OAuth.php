<?php

namespace Guesl\Clover\Models;

use Guesl\Clover\HttpClient;
use Illuminate\Support\Facades\Log;

class OAuth extends Clover
{
    /**
     * @param null $clientId
     * @param null $clientSecret
     * @param null $authCode
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function accessToken($clientId = null, $clientSecret = null, $authCode = null)
    {
        Log::debug('OAuth::accessToken => Get the access token by client id and client secret.');

        $clientId = $clientId ?? config('clover.client_id');
        $clientSecret = $clientSecret ?? config('clover.client_secret');
        $authCode = $authCode ?? config('clover.auth_code');

        $baseUrl = static::getBaseUrl();

        $client = HttpClient::getInstance($baseUrl, [
            'query' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'code' => $authCode,
            ],
        ]);

        $response = $client->post('oauth/token');
        return $response;
    }
}
