<?php

namespace Guesl\Clover\Models\Inventory;

use Guesl\Clover\Models\Clover;

/**
 * Class ModifierGroup
 * @package Guesl\Clover\Models\Inventory
 */
class ModifierGroup extends Clover
{
    /**
     * Create a modifier group.
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

        $result = $httpClient->post("$version/merchants/$merchantId/modifier_groups", [
            'json' => $data,
        ]);

        return $result;
    }

    /**
     * Delete an existing modifier group, identified by UUID. This also deletes all modifiers within that group.
     *
     * @param $modifierGroupId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete($modifierGroupId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $result = $httpClient->delete("$version/merchants/$merchantId/modifier_groups/$modifierGroupId");

        return $result;
    }
}
