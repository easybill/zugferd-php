<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineItem
{
    /**
     * @var LineDocument
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\Item\LineDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('AssociatedDocumentLineDocument')]
    private $lineDocument;

    /**
     * @var SpecifiedTradeAgreement
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeAgreement')]
    private $tradeAgreement;

    /**
     * @var SpecifiedTradeDelivery
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeDelivery')]
    private $delivery;

    /**
     * @var SpecifiedTradeSettlement
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedSupplyChainTradeSettlement')]
    private $settlement;

    /**
     * @var Product
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\Item\Product::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedTradeProduct')]
    private $product;

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\LineDocument
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
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement
     */
    public function getTradeAgreement()
    {
        return $this->tradeAgreement;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement $tradeAgreement
     *
     * @return self
     */
    public function setTradeAgreement($tradeAgreement)
    {
        $this->tradeAgreement = $tradeAgreement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\Product
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
