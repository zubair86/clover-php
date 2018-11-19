<?php

namespace Guesl\Clover\Models;

/**
 * Class Merchant
 * @package Guesl\Clover\Models
 */
class Merchant extends Clover
{
    /**
     * Retrieve the merchant info.
     *
     * @param $merchantId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($merchantId)
    {
        $httpClient = Clover::getHttpClient();

        $merchant = $httpClient->get("merchants/$merchantId");

        return $merchant;
    }
}
