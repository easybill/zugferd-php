<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineItem
{

    /**
     * @var LineDocument
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\LineDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("AssociatedDocumentLineDocument")
     */
    private $lineDocument;

    /**
     * @var SpecifiedTradeAgreement
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedSupplyChainTradeAgreement")
     */
    private $tradeAgreement;

    /**
     * @var SpecifiedTradeDelivery
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedSupplyChainTradeDelivery")
     */
    private $delivery;

    /**
     * @var SpecifiedTradeSettlement
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedSupplyChainTradeSettlement")
     */
    private $settlement;

    /**
     * @var Product
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\Product")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeProduct")
     */
    private $product;

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\LineDocument
     */
    public function getLineDocument()
    {
        return $this->lineDocument;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\LineDocument $lineDocument
     *
     * @return self
     */
    public function setLineDocument(LineDocument $lineDocument)
    {
        $this->lineDocument = $lineDocument;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement
     */
    public function getTradeAgreement()
    {
        return $this->tradeAgreement;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement $tradeAgreement
     *
     * @return self
     */
    public function setTradeAgreement($tradeAgreement)
    {
        $this->tradeAgreement = $tradeAgreement;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\Product $product
     *
     * @return self
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

}