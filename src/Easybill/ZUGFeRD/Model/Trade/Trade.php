<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * Class Trade
 *
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class Trade
{

    /**
     * @var Agreement
     * @Type("Easybill\ZUGFeRD\Model\Trade\Agreement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ApplicableSupplyChainTradeAgreement")
     */
    private $agreement = '';

    /**
     * @var Delivery
     * @Type("Easybill\ZUGFeRD\Model\Trade\Delivery")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ApplicableSupplyChainTradeDelivery")
     */
    private $delivery;

    /**
     * @var Settlement
     * @Type("Easybill\ZUGFeRD\Model\Trade\Settlement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ApplicableSupplyChainTradeSettlement")
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
     * @return \Easybill\ZUGFeRD\Model\Trade\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Delivery $delivery
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Settlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Settlement $settlement
     *
     * @return self
     */
    public function setSettlement($settlement)
    {
        $this->settlement = $settlement;
        return $this;
    }



}