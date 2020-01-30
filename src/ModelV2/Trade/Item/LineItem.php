<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineItem
{

    /**
     * @var LineDocument
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\LineDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("AssociatedDocumentLineDocument")
     */
    private $lineDocument;

    /**
     * @var Product
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\Product")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeProduct")
     */

    private $product;
    /**
     * @var SpecifiedTradeAgreement
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeAgreement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeAgreement")
     */
    private $tradeAgreement;

    /**
     * @var SpecifiedTradeDelivery
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeDelivery")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeDelivery")
     */
    private $delivery;

    /**
     * @var SpecifiedTradeSettlement
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeSettlement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeSettlement")
     */
    private $settlement;



    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\LineDocument
     */
    public function getLineDocument()
    {
        return $this->lineDocument;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\LineDocument $lineDocument
     *
     * @return self
     */
    public function setLineDocument(LineDocument $lineDocument)
    {
        $this->lineDocument = $lineDocument;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeAgreement
     */
    public function getTradeAgreement()
    {
        return $this->tradeAgreement;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeAgreement $tradeAgreement
     *
     * @return self
     */
    public function setTradeAgreement($tradeAgreement)
    {
        $this->tradeAgreement = $tradeAgreement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeDelivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeDelivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeSettlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeSettlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\Product $product
     *
     * @return self
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

}