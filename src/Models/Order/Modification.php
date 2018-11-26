<?php

namespace Guesl\Clover\Models\Order;

use Guesl\Clover\Models\Clover;

/**
 * Class Modification
 * @package Guesl\Clover\Models\Order
 */
class Modification extends Clover
{
    /**
     * Apply a modification to a line item.
     *
     * @param $merchantId
     * @param $orderId
     * @param $orderItemId
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function apply($merchantId, $orderId, $orderItemId, $data = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/line_items/$orderItemId/modifications", [
            'json' => $data,
        ]);

        return $result;
    }
}
