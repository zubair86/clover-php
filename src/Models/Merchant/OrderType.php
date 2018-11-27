<?php

namespace Guesl\Clover\Models\Merchant;

use Guesl\Clover\Models\Clover;

/**
 * Class Employee
 * @package Guesl\Clover\Models\Employee
 */
class OrderType extends Clover
{
    /**
     * Create an order type.
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($data = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->post("$version/merchants/$merchantId/order_types", [
            'json' => $data,
        ]);

        return $result;
    }

    /**
     * Retrieve an order type.
     *
     * @param $orderTypeId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($orderTypeId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->get("$version/merchants/$merchantId/order_types/$orderTypeId");

        return $result;
    }
}
