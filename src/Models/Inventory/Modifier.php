<?php

namespace Guesl\Clover\Models\Inventory;

use Guesl\Clover\Models\Clover;

/**
 * Class Modifier
 * @package Guesl\Clover\Models\Inventory
 */
class Modifier extends Clover
{
    /**
     * Create a modifier.
     *
     * @param $merchantId
     * @param $modifierGroupId
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $modifierGroupId, $data = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/modifier_groups/$modifierGroupId/modifiers", [
            'json' => $data,
        ]);

        return $result;
    }
}
