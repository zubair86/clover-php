<?php

namespace Guesl\Clover\Models\Order;

use Guesl\Clover\Models\Clover;

/**
 * Class BulkOrderItem
 * @package Guesl\Clover\Models\Order
 */
class BulkOrderItem extends Clover
{
    /**
     * Create bulk order items.
     *
     * @param $merchantId
     * @param $orderId
     * @param array $orderItemsData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $orderId, $orderItemsData = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/bulk_line_items", [
            'json' => $orderItemsData,
        ]);

        return $result;
    }

    /**
     * Create bulk order items using a tax rate.
     *
     * @param $merchantId
     * @param $orderId
     * @param array $orderItemsData
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createWithSingleTaxRate($merchantId, $orderId, $orderItemsData = [], $taxRateData = [])
    {
        $httpClient = Clover::getHttpClient();

        for ($i = 0; $i < sizeof($orderItemsData); $i++) {
            $orderItemsData[$i]['taxRates'] = [
                $taxRateData
            ];
        }

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/bulk_line_items", [
            'json' => [
                'items' => $orderItemsData,
            ],
        ]);

        return $result;
    }
}
