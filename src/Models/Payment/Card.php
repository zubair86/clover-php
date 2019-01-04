<?php

namespace Guesl\Clover\Models\Card;

use Guesl\Clover\Models\Clover;

/**
 * Class Card
 * @package Guesl\Clover\Models\Card
 */
class Card extends Clover
{
    /**
     * @var
     */
    protected $cardNumber;

    /**
     * @var
     */
    protected $expirationYear;

    /**
     * @var
     */
    protected $expirationMonth;

    /**
     * @var
     */
    protected $cvv;

    /**
     * @var
     */
    protected $zipCode;

    /**
     * Card constructor.
     *
     * @param $cardNumber
     * @param $expirationYear
     * @param $expirationMonth
     * @param $cvv
     * @param $zipCode
     */
    public function __construct($cardNumber, $expirationYear, $expirationMonth, $cvv, $zipCode)
    {
        $this->cardNumber = $cardNumber;
        $this->expirationYear = $expirationYear;
        $this->expirationMonth = $expirationMonth;
        $this->cvv = $cvv;
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cardNumber
     * @return Card
     */
    public function setCardNumber($cardNumber): Card
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * @param mixed $expirationYear
     * @return Card
     */
    public function setExpirationYear($expirationYear): Card
    {
        $this->expirationYear = $expirationYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * @param mixed $expirationMonth
     * @return Card
     */
    public function setExpirationMonth($expirationMonth): Card
    {
        $this->expirationMonth = $expirationMonth;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param mixed $cvv
     * @return Card
     */
    public function setCvv($cvv): Card
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     * @return Card
     */
    public function setZipCode($zipCode): Card
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return bool|string
     */
    public function getFirst6()
    {
        return substr($this->getCardNumber(), 0, 6);
    }

    /**
     * @return bool|string
     */
    public function getLast4()
    {
        return substr($this->getCardNumber(), -4);
    }
}
