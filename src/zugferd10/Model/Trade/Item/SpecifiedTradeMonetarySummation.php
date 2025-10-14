<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class SpecifiedTradeMonetarySummation
{
    /**
     * @var Amount
     */
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('LineTotalAmount')]
    private $totalAmount;

    /**
     * @var Amount
     */
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('TotalAllowanceChargeAmount')]
    private $totalAllowanceChargeAmount;

    /**
     * SpecifiedMonetarySummation constructor.
     *
     * @param float $value
     * @param string $currency
     */
    public function __construct($value, $currency = 'EUR')
    {
        $this->totalAmount = new Amount($value, $currency);
    }

    /**
     * @return Amount
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param Amount $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return Amount
     */
    public function getTotalAllowanceChargeAmount()
    {
        return $this->totalAllowanceChargeAmount;
    }

    /**
     * @param Amount $totalAllowanceChargeAmount
     */
    public function setTotalAllowanceChargeAmount($totalAllowanceChargeAmount)
    {
        $this->totalAllowanceChargeAmount = $totalAllowanceChargeAmount;
    }
}
