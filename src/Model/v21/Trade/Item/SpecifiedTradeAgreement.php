<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Groups;

class SpecifiedTradeAgreement
{
    /**
     * @var Price
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("NetPriceProductTradePrice")
     */
    private $netPrice;

    /**
     * @var Price
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Item\Price")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GrossPriceProductTradePrice")
     * @Groups({"extended"})
     */
    private $grossPrice;

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Item\Price
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Item\Price $grossPrice
     *
     * @return self
     */
    public function setGrossPrice($grossPrice)
    {
//        error_log(print_r($grossPrice, true));

        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Item\Price
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Item\Price $netPrice
     *
     * @return self
     */
    public function setNetPrice($netPrice)
    {
//        error_log(print_r($netPrice, true));

        $this->netPrice = $netPrice;
        return $this;
    }

}