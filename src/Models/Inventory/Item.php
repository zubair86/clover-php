<?php

namespace Guesl\Clover\Models\Inventory;


use Guesl\Clover\Models\Clover;

/**
 * Class Item
 * @package Guesl\Clover\Models\Inventory
 */
class Item extends Clover
{
    /**
     * Create inventory item
     *
     * @param array $itemData
     * @return mixed
     */
    public static function create($itemData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $item = $result = $httpClient->post("$version/merchants/$merchantId/items", [
            'json' => $itemData,
        ]);

        return $item;
    }
}