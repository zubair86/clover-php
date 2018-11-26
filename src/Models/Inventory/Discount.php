<?php

namespace Guesl\Clover\Models\Inventory;

use Guesl\Clover\Models\Clover;

/**
 * Class Discount
 * @package Guesl\Clover\Models\Inventory
 */
class Discount extends Clover
{
    /**
     * Create a discount.
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($data = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->post("$version/merchants/$merchantId/discounts", [
            'json' => $data,
        ]);

        return $result;
    }
}
