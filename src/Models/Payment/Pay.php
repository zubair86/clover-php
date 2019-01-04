<?php

namespace Guesl\Clover\Models\Payment;

use Guesl\Clover\Models\Card\Card;
use Guesl\Clover\Models\Clover;
use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

/**
 * Class Pay
 * @package Guesl\Clover\Models\Payment
 */
class Pay extends Clover
{
    /**
     * Get encryption info.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getEncryption()
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::PAY_VERSION;

        $encryptionInfo = $httpClient->get("$version/merchant/$merchantId/pay/key");

        return $encryptionInfo;
    }

    /**
     * @param $cloverOrderId
     * @param Card $card
     * @param int $amount
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function postPayment($cloverOrderId, Card $card, int $amount)
    {
        $httpClient = self::getHttpClient();
        $merchantId = self::getMerchantId();
        $version = self::PAY_VERSION;

        $encryptionInfo = self::getEncryption();
        $cardEncrypted = self::encryptCard($encryptionInfo, $card);

        $payment = $httpClient->post("$version/merchant/$merchantId/pay", [
            "json" => [
                "orderId" => $cloverOrderId,
                "taxAmount" => 0,
                "amount" => $amount,
                "currency" => "usd",
                "expYear" => $card->getExpirationYear(),
                "expMonth" => $card->getExpirationMonth(),
                "cvv" => $card->getCvv(),
                "zip" => $card->getZipCode(),
                "first6" => $card->getFirst6(),
                "last4" => $card->getLast4(),
                "cardEncrypted" => $cardEncrypted
            ]
        ]);

        return $payment;
    }

    /**
     * @param $encryptionInfo
     * @param Card $card
     * @return string
     */
    public static function encryptCard($encryptionInfo, Card $card)
    {
        $prefix = $encryptionInfo["prefix"];
        $modulus = $encryptionInfo["modulus"];
        $exponent = $encryptionInfo["exponent"];

        $stringToEnc = $prefix . $card->getCardNumber();

        $modulus = new BigInteger($modulus);
        $exponent = new BigInteger($exponent);

        $rsa = new RSA();
        $rsa->loadKey(['n' => $modulus, 'e' => $exponent]);
        $rsa->setEncryptionMode(RSA::ENCRYPTION_OAEP);

        $cipherText = $rsa->encrypt($stringToEnc);

        $cardEncrypted = base64_encode($cipherText);

        return $cardEncrypted;
    }
}
