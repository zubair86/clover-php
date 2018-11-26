<?php

namespace Guesl\Clover\Models\Merchant;

use Guesl\Clover\Models\Clover;

/**
 * Class Merchant
 * @package Guesl\Clover\Models
 */
class Merchant extends Clover
{
    /**
     * Retrieve the merchant info.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve()
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $merchant = $httpClient->get("$version/merchants/$merchantId");

        return $merchant;
    }
}
