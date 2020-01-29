<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeAgreement
{

    /**
     * @var Price
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GrossPriceProductTradePrice")
     */
    private $grossPrice;

    /**
     * @var Price
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("NetPriceProductTradePrice")
     */
    private $netPrice;

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\Price
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\Price $grossPrice
     *
     * @return self
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\Price
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\Price $netPrice
     *
     * @return self
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;
        return $this;
    }

}