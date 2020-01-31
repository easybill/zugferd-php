<?php namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Agreement
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BuyerReference")
     */
    private $buyerReference;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SellerTradeParty")
     */
    private $seller;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BuyerTradeParty")
     */
    private $buyer;

    /**
     * @return string
     */
    public function getBuyerReference()
    {
        return $this->buyerReference;
    }

    /**
     * @param string $buyerReference
     *
     * @return self
     */
    public function setBuyerReference($buyerReference)
    {
        $this->buyerReference = $buyerReference;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\TradeParty
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\TradeParty $seller
     *
     * @return self
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\TradeParty
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\TradeParty $buyer
     *
     * @return self
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
        return $this;
    }


}