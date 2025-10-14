<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class SpecifiedTradeAgreement
{
    /**
     * @var Price
     */
    #[Type(Price::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('GrossPriceProductTradePrice')]
    private $grossPrice;

    /**
     * @var Price
     */
    #[Type(Price::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('NetPriceProductTradePrice')]
    private $netPrice;

    /**
     * @return Price
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @param Price $grossPrice
     *
     * @return self
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return Price
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param Price $netPrice
     *
     * @return self
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;
        return $this;
    }
}
