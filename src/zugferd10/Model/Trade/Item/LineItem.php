<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class LineItem
{
    /**
     * @var LineDocument
     */
    #[Type(LineDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('AssociatedDocumentLineDocument')]
    private $lineDocument;

    /**
     * @var SpecifiedTradeAgreement
     */
    #[Type(SpecifiedTradeAgreement::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeAgreement')]
    private $tradeAgreement;

    /**
     * @var SpecifiedTradeDelivery
     */
    #[Type(SpecifiedTradeDelivery::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeDelivery')]
    private $delivery;

    /**
     * @var SpecifiedTradeSettlement
     */
    #[Type(SpecifiedTradeSettlement::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeSettlement')]
    private $settlement;

    /**
     * @var Product
     */
    #[Type(Product::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedTradeProduct')]
    private $product;

    /**
     * @return LineDocument
     */
    public function getLineDocument()
    {
        return $this->lineDocument;
    }

    /**
     * @return self
     */
    public function setLineDocument(LineDocument $lineDocument)
    {
        $this->lineDocument = $lineDocument;
        return $this;
    }

    /**
     * @return SpecifiedTradeAgreement
     */
    public function getTradeAgreement()
    {
        return $this->tradeAgreement;
    }

    /**
     * @param SpecifiedTradeAgreement $tradeAgreement
     *
     * @return self
     */
    public function setTradeAgreement($tradeAgreement)
    {
        $this->tradeAgreement = $tradeAgreement;
        return $this;
    }

    /**
     * @return SpecifiedTradeDelivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param SpecifiedTradeDelivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return SpecifiedTradeSettlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param SpecifiedTradeSettlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return self
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }
}
