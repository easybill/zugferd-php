<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\Trade\Item\LineItem;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class Trade
{

    /**
     * @var LineItem[]
     * @Type("array<Easybill\ZUGFeRD\Model\v21\Trade\Item\LineItem>")
     * @XmlList(inline=true, entry="IncludedSupplyChainTradeLineItem", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    private $lineItems = array();

    /**
     * @var Agreement
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Agreement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeAgreement")
     */
    private $agreement;

    /**
     * @var Delivery
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Delivery")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeDelivery")
     */
    private $delivery;

    /**
     * @var Settlement
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Settlement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeSettlement")
     */
    private $settlement;

    public function __construct()
    {
        $this->agreement = new Agreement();
        $this->delivery = new Delivery();
        $this->settlement = new Settlement();
    }

    /**
     * @return Agreement
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    /**
     * @param Agreement $agreement
     *
     * @return self
     */
    public function setAgreement(Agreement $agreement)
    {
        $this->agreement = $agreement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Delivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Settlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Settlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Item\LineItem[]
     */
    public function getLineItems()
    {
        return $this->lineItems;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Item\LineItem $lineItem
     *
     * @return self
     */
    public function addLineItem(LineItem $lineItem)
    {
        $this->lineItems[] = $lineItem;
        return $this;
    }

}