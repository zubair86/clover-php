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
     * @var
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
    private static $merchantId;

    /**
     * @var
     */
    private static $accessToken;

    /**
     * @return HttpClient
     */
    protected static function getHttpClient()
    {
        $accessToken = static::getAccessToken();
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
            $clientSecret = config('clover.client_secret');
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
            $clientId = config('clover.client_id');
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
    public static function getMerchantId()
    {
        return self::$merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public static function setMerchantId($merchantId): void
    {
        self::$merchantId = $merchantId;
    }

    /**
     * @return mixed
     */
    public static function getAccessToken()
    {
        return self::$accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public static function setAccessToken($accessToken): void
    {
        self::$accessToken = $accessToken;
    }

}
