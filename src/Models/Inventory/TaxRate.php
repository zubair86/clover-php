<?php

namespace Guesl\Clover\Models\Inventory;

use Guesl\Clover\Models\Clover;

/**
 * Class TaxRate
 * @package Guesl\Clover\Models\Inventory
 */
class TaxRate extends Clover
{
    /**
     * Retrieve the tax rate by id.
     *
     * @param $taxRateId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($taxRateId)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $taxRate = $httpClient->get("$version/merchants/$merchantId/tax_rates/$taxRateId");

        return $taxRate;

    }

    /**
     * Create a tax rate.
     *
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($taxRateData = [])
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::VERSION;

        $taxRate = $httpClient->post("$version/merchants/$merchantId/tax_rates", [
            'json' => $taxRateData,
        ]);

        return $taxRate;
    }
}
