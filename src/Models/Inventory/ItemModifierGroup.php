<?php

namespace Guesl\Clover\Models\Inventory;


use Guesl\Clover\Models\Clover;

/**
 * Class ItemModifierGroup
 * @package Guesl\Clover\Models\Inventory
 */
class ItemModifierGroup extends Clover
{
    public static function create($itemModifierGroupData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $data = $result = $httpClient->post("$version/merchants/$merchantId/item_modifier_groups", [
            'json' => $itemModifierGroupData,
        ]);

        return $data;
    }
}