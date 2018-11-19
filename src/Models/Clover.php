<?php

namespace Guesl\Clover\Models;

use Guesl\Clover\HttpClient;

/**
 * Class Clover
 * @package Guesl\Clover\Models
 */
class Clover
{
    /**
     * Sandbox api url.
     */
    const SANDBOX_URL = 'https://apisandbox.dev.clover.com/';

    /**
     * Production api url.
     */
    const PRODUCTION_URL = 'https://api.clover.com/';

    /**
     *
     */
    const VERSION = 'v3';

    /**
     * @var
     */
    protected static $baseUrl;

    /**
     * @var
     */
    private static $clientId;

    /**
     * @var
     */
    private static $clientSecret;

    /**
     * @var
     */
    private static $authCode;

    /**
     * @var
     */
    private static $apiToken;


    /**
     * @return HttpClient
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected static function getHttpClient()
    {
        if (env('APP_ENV') != 'production') {
            $token = static::getApiToken();

        } else {
            $authCode = static::getAuthCode();
            $clientId = static::getClientId();
            $clientSecret = static::getClientSecret();

            $token = OAuth::accessToken($clientId, $clientSecret, $authCode);
        }

        $accessToken = $token;

        $baseUrl = static::getBaseUrl();

        $client = HttpClient::getInstance($baseUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ],
        ]);

        return $client;
    }

    /**
     * Get the base url basic on the env configuration.
     */
    public static function getBaseUrl()
    {
        $baseUrl = static::$baseUrl;
        if (!isset($baseUrl)) {
            $baseUrl = self::PRODUCTION_URL;
            if (env('APP_ENV') != 'production') {
                $baseUrl = self::SANDBOX_URL;
            }
        }

        return $baseUrl;
    }

    /**
     * @param $baseUrl
     */
    public static function setBaseUrl($baseUrl): void
    {
        self::$baseUrl = $baseUrl;
    }

    /**
     * @return mixed
     */
    public static function getClientSecret()
    {
        $clientSecret = self::$clientSecret;
        if (!isset($clientSecret)) {
            $clientSecret = config('services.loyalty.client_secret');
        }

        return $clientSecret;
    }

    /**
     * @param $clientSecret
     */
    public static function setClientSecret($clientSecret): void
    {
        self::$clientSecret = $clientSecret;
    }


    /**
     * @return mixed
     */
    public static function getClientId()
    {
        $clientId = self::$clientId;
        if (!isset($clientId)) {
            $clientId = config('services.loyalty.client_id');
        }

        return $clientId;
    }

    /**
     * @param $clientId
     */
    public static function setClientId($clientId): void
    {
        self::$clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public static function getAuthCode()
    {
        return self::$authCode;
    }

    /**
     * @param $authCode
     */
    public static function setAuthCode($authCode): void
    {
        self::$authCode = $authCode;
    }

    /**
     * @return mixed
     */
    public static function getApiToken()
    {
        return self::$apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public static function setApiToken($apiToken): void
    {
        self::$apiToken = $apiToken;
    }
}
