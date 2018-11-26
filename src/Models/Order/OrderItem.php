<?php

namespace Guesl\Clover\Models\Order;

use Guesl\Clover\Models\Clover;

/**
 * Class OrderItem
 * @package Guesl\Clover\Models\Order
 */
class OrderItem extends Clover
{
    /**
     * Create an order item.
     *
     * @param $orderId
     * @param array $orderItemData
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($orderId, $orderItemData = [], $taxRateData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        if (!empty($taxRateData)) {
            $orderItemData = array_merge($orderItemData, [
                'taxRates' => $taxRateData
            ]);
        }

        $order = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/line_items", [
            'json' => $orderItemData,
        ]);

        return $order;
    }
}
