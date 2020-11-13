<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\XmlList;

class TradeSettlementHeaderMonetarySummation
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("LineTotalAmount")
     */
    public ?Amount $lineTotalAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ChargeTotalAmount")
     */
    public ?Amount $chargeTotalAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("AllowanceTotalAmount")
     */
    public ?Amount $allowanceTotalAmount = null;

    /**
     * @var Amount[]
     * @JMS\Type("array<Easybill\ZUGFeRD211\Model\Amount>")
     * @XmlList(inline = true, entry = "TaxBasisTotalAmount", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $taxBasisTotalAmount = [];

    /**
     * @var Amount[]
     * @JMS\Type("array<Easybill\ZUGFeRD211\Model\Amount>")
     * @XmlList(inline = true, entry = "TaxTotalAmount", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $taxTotalAmount = [];

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("RoundingAmount")
     */
    public ?Amount $roundingAmount = null;

    /**
     * @var Amount[]
     * @JMS\Type("array<Easybill\ZUGFeRD211\Model\Amount>")
     * @XmlList(inline = true, entry = "GrandTotalAmount", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $grandTotalAmount = [];

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("TotalPrepaidAmount")
     */
    public ?Amount $totalPrepaidAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DuePayableAmount")
     */
    public Amount $duePayableAmount;
}
