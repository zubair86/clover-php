<?php

namespace Guesl\Clover\Models\Inventory;


use Guesl\Clover\Models\Clover;

/**
 * Class ItemModifierGroup
 * @package Guesl\Clover\Models\Inventory
 */
class ItemModifierGroup extends Clover
{
    /**
     * Create an Item modifier group.
     *
     * @param array $itemModifierGroupData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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