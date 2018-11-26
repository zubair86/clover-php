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
     * @param $merchantId
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $data = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $result = $httpClient->post("$version/merchants/$merchantId/modifier_groups", [
            'json' => $data,
        ]);

        return $result;
    }
}
