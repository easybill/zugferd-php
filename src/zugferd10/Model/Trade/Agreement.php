<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Agreement
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('BuyerReference')]
    private $buyerReference;

    /**
     * @var TradeParty
     */
    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SellerTradeParty')]
    private $seller;

    /**
     * @var TradeParty
     */
    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('BuyerTradeParty')]
    private $buyer;

    /**
     * @var ReferencedDocument
     */
    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('BuyerOrderReferencedDocument')]
    private $buyerOrder;

    /**
     * @var ReferencedDocument[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\Trade\ReferencedDocument>')]
    #[XmlList(inline: true, entry: 'AdditionalReferencedDocument', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    private $additionalReferencedDocuments;

    /**
     * @var ReferencedDocument
     */
    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('CustomerOrderReferencedDocument')]
    private $customerOrderReferencedDocument;

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
     * @return TradeParty
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param TradeParty $seller
     *
     * @return self
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return TradeParty
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param TradeParty $buyer
     *
     * @return self
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
        return $this;
    }

    /**
     * @return ReferencedDocument
     */
    public function getBuyerOrder()
    {
        return $this->buyerOrder;
    }

    /**
     * @return Agreement
     */
    public function setBuyerOrder(ReferencedDocument $buyerOrder)
    {
        $this->buyerOrder = $buyerOrder;
        return $this;
    }

    /**
     * @return ReferencedDocument[]
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
     * @return ReferencedDocument
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
