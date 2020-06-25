<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Agreement
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerReference")
     */
    private $buyerReference;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SellerTradeParty")
     */
    private $seller;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerTradeParty")
     */
    private $buyer;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SellerTaxRepresentativeTradeParty")
     */
    private $sellerTaxRepresentative;

    /**
     * @return string
     */
    public function getBuyerReference()
    {
        return $this->name;
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
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty $seller
     *
     * @return self
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty $buyer
     *
     * @return self
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty
     */
    public function getSellerTaxRepresentative()
    {
        return $this->sellerTaxRepresentative;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\TradeParty $sellerTaxRepresentative
     *
     * @return self
     */
    public function setSellerTaxRepresentative($sellerTaxRepresentative)
    {
        $this->sellerTaxRepresentative = $sellerTaxRepresentative;
        return $this;
    }


}