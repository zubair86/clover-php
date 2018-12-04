<?php

namespace Guesl\Clover\Models\Inventory;


use Guesl\Clover\Models\Clover;

/**
 * Class Category
 * @package Guesl\Clover\Models\Inventory
 */
class Category extends Clover
{
    /**
     * Create a item category
     *
     * @param array $categoryData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($categoryData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $category = $result = $httpClient->post("$version/merchants/$merchantId/categories", [
            'json' => $categoryData,
        ]);

        return $category;
    }
}
