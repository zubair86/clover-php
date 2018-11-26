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
