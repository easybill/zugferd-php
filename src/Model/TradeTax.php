<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class TradeTax
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("CalculatedAmount")
     */
    public ?Amount $calculatedAmount = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("TypeCode")
     */
    public string $typeCode;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ExemptionReason")
     */
    public ?string $exemptionReason = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("BasisAmount")
     */
    public ?Amount $basisAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("LineTotalBasisAmount")
     */
    public ?Amount $lineTotalBasisAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("AllowanceChargeBasisAmount")
     */
    public ?Amount $allowanceChargeBasisAmount = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ApplicablePercent")
     */
    public ?string $applicablePercent = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("CategoryCode")
     */
    public ?string $categoryCode = null;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("ExemptionReasonCode")
     */
    public ?string $exemptionReasonCode = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\DateTime")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("TaxPointDate")
     */
    public ?DateTime $taxPointDate = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DueDateTypeCode")
     */
    public ?string $dueDateTypeCode = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("RateApplicablePercent")
     */
    public ?string $rateApplicablePercent = null;
}
