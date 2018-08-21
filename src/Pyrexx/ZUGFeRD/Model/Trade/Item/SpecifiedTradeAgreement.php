<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeAgreement
{

    /**
     * @var Price
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GrossPriceProductTradePrice")
     */
    private $grossPrice;

    /**
     * @var Price
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("NetPriceProductTradePrice")
     */
    private $netPrice;

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\Price
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\Price $grossPrice
     *
     * @return self
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\Price
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\Price $netPrice
     *
     * @return self
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;
        return $this;
    }

}