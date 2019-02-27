<?php

namespace Guesl\Clover\Models\Order;

use Guesl\Clover\Models\Clover;

/**
 * Class Order
 * @package Guesl\Clover\Models\Order
 */
class Order extends Clover
{
    /**
     * Create an order.
     *
     * @param array $orderData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($orderData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $order = $httpClient->post("$version/merchants/$merchantId/orders", [
            'json' => $orderData,
        ]);

        return $order;
    }

    /**
     * Delete the clover order.
     *
     * @param $orderId
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete($orderId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $httpClient->delete("$version/merchants/$merchantId/orders/$orderId");
    }
}
