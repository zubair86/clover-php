<?php

namespace Guesl\Clover\Models\Inventory;


use Guesl\Clover\Models\Clover;

/**
 * Class CategoryItem
 * @package Guesl\Clover\Models\Inventory
 */
class CategoryItem extends Clover
{
    /**
     * Create item/category association
     *
     * @param array $categoryItemData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($categoryItemData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $categoryItem = $result = $httpClient->post("$version/merchants/$merchantId/category_items", [
            'json' => $categoryItemData,
        ]);

        return $categoryItem;
    }
}
