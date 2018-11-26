<?php

namespace Guesl\Clover\Models;

class BulkOrderItem extends Clover
{
    /**
     * Create an order.
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
     * @param $merchantId
     * @param $orderId
     * @param array $orderItemsData
     * @param null $taxRateId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createWithSingleTaxRate($merchantId, $orderId, $orderItemsData = [], $taxRateId = null)
    {
        $httpClient = Clover::getHttpClient();

        if (isset($taxRateId)) {
            for ($i = 0; $i < sizeof($orderItemsData); $i++) {
                $orderItemsData['taxRates'] = [[
                    'id' => $taxRateId,
                ]];
            }
        }

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/bulk_line_items", [
            'json' => $orderItemsData,
        ]);

        return $result;
    }
}
