<?php

namespace Guesl\Clover\Models;

use Guesl\Clover\HttpClient;
use Illuminate\Support\Facades\Log;

class OAuth extends Clover
{
    /**
     * Sandbox api url.
     */
    const SANDBOX_URL = "https://sandbox.dev.clover.com/";

    /**
     * Production api url.
     */
    const PRODUCTION_URL = "https://www.clover.com/";

    /**
     * @param $clientId
     * @param $clientSecret
     * @param $authCode
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function accessToken($clientId, $clientSecret, $authCode)
    {
        Log::debug("OAuth::accessToken => Get the access token by client id and client secret.");

        $clientId = $clientId ?? config("clover.client_id");
        $clientSecret = $clientSecret ?? config("clover.client_secret");
        $authCode = $authCode ?? config("clover.auth_code");

        if (config("clover.env") != "production") {
            $baseUrl = static::SANDBOX_URL;
        } else {
            $baseUrl = static::PRODUCTION_URL;
        }

        $client = HttpClient::getInstance($baseUrl, [
            "query" => [
                "client_id" => $clientId,
                "client_secret" => $clientSecret,
                "code" => $authCode,
            ],
        ]);

        $response = $client->get("oauth/token");

        $accessToken = $response["access_token"];
        return $accessToken;
    }
}
