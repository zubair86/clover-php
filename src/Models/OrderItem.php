<?php

namespace Guesl\Clover\Models;

class OrderItem extends Clover
{
    /**
     * Create an order.
     *
     * @param $merchantId
     * @param $orderId
     * @param array $orderItemData
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $orderId, $orderItemData = [], $taxRateData = [])
    {
        $httpClient = Clover::getHttpClient();

        if (!empty($taxRateData)) {
            $orderItemData = array_merge($orderItemData, [
                'taxRates' => $taxRateData
            ]);
        }

        $version = static::VERSION;
        $order = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/line_items", [
            'json' => $orderItemData,
        ]);

        return $order;
    }
}
