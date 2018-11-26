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
     * @param $orderId
     * @param $orderItemId
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function apply($orderId, $orderItemId, $data = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->post("$version/merchants/$merchantId/orders/$orderId/line_items/$orderItemId/modifications", [
            'json' => $data,
        ]);

        return $result;
    }
}
