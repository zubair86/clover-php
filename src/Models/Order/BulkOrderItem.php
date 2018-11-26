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
     * @param $orderId
     * @param array $orderItemsData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($orderId, $orderItemsData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/bulk_line_items", [
            'json' => $orderItemsData,
        ]);

        return $result;
    }

    /**
     * Create bulk order items using a tax rate.
     *
     * @param $orderId
     * @param array $orderItemsData
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createWithSingleTaxRate($orderId, $orderItemsData = [], $taxRateData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        for ($i = 0; $i < sizeof($orderItemsData); $i++) {
            $orderItemsData[$i]['taxRates'] = [
                $taxRateData
            ];
        }

        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/bulk_line_items", [
            'json' => [
                'items' => $orderItemsData,
            ],
        ]);

        return $result;
    }
}
