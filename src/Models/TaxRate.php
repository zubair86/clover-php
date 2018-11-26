<?php

namespace Guesl\Clover\Models;

class TaxRate extends Clover
{
    /**
     * Create an order.
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
