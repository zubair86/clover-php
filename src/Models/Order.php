<?php

namespace Guesl\Clover\Models;

class Order extends Clover
{
    /**
     * Create an order.
     *
     * @param $merchantId
     * @param array $orderData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $orderData = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $order = $httpClient->post("$version/merchants/$merchantId/orders", [
            'json' => $orderData
        ]);

        return $order;
    }
}
