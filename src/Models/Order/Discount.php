<?php

namespace Guesl\Clover\Models\Order;

use Guesl\Clover\Models\Clover;

/**
 * Class Discount
 * @package Guesl\Clover\Models\Order
 */
class Discount extends Clover
{
    /**
     * Create a discount.
     *
     * @param $orderId
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($orderId, $data = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/discounts", [
            'json' => $data,
        ]);

        return $result;
    }
}
