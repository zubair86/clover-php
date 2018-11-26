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
     * @param $merchantId
     * @param $taxRateId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($merchantId, $taxRateId)
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $taxRate = $httpClient->get("$version/merchants/$merchantId/tax_rates/$taxRateId");

        return $taxRate;
    }

    /**
     * Create a tax rate.
     *
     * @param $merchantId
     * @param array $taxRateData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($merchantId, $taxRateData = [])
    {
        $httpClient = Clover::getHttpClient();

        $version = static::VERSION;
        $taxRate = $httpClient->post("$version/merchants/$merchantId/tax_rates", [
            'json' => $taxRateData,
        ]);

        return $taxRate;
    }
}
