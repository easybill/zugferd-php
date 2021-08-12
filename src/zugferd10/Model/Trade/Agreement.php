<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

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
     * @var ReferencedDocument
     * @Type("Easybill\ZUGFeRD\Model\Trade\ReferencedDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BuyerOrderReferencedDocument")
     */
    private $buyerOrder;

    /**
     * @var ReferencedDocument[]
     * @Type("array<Easybill\ZUGFeRD\Model\Trade\ReferencedDocument>")
     * @XmlList(inline = true, entry = "AdditionalReferencedDocument", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $additionalReferencedDocuments;

    /**
     * @var ReferencedDocument
     * @Type("Easybill\ZUGFeRD\Model\Trade\ReferencedDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("CustomerOrderReferencedDocument")
     */
    private $customerOrderReferencedDocument;

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

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\ReferencedDocument
     */
    public function getBuyerOrder()
    {
        return $this->buyerOrder;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\ReferencedDocument $buyerOrder
     * @return Agreement
     */
    public function setBuyerOrder(ReferencedDocument $buyerOrder)
    {
        $this->buyerOrder = $buyerOrder;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\ReferencedDocument[]
     */
    public function getAdditionalReferencedDocuments()
    {
        return $this->additionalReferencedDocuments;
    }

    /**
     * @return self
     */
    public function addAdditionalReferencedDocument(ReferencedDocument $additionalReferencedDocument)
    {
        $this->additionalReferencedDocuments[] = $additionalReferencedDocument;

        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\ReferencedDocument
     */
    public function getCustomerOrderReferencedDocument()
    {
        return $this->customerOrderReferencedDocument;
    }

    /**
     * @return self
     */
    public function setCustomerOrderReferencedDocument(ReferencedDocument $customerOrderReferencedDocument)
    {
        $this->customerOrderReferencedDocument = $customerOrderReferencedDocument;
        return $this;
    }
}
