<?php

namespace Easybill\ZUGFeRD\Model;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use Easybill\ZUGFeRD\Model\Trade\Item\Quantity;
use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AllowanceCharge.
 */
class AllowanceCharge
{
    /**
     * @var Indicator
     * @JMS\Type("Easybill\ZUGFeRD\Model\Indicator")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ChargeIndicator")
     */
    private $indicator;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("SequenceNumeric")
     */
    private $sequenceNumeric;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("CalculationPercent")
     */
    private $calculationPercent;

    /**
     * @var Quantity
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Quantity")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("BasisQuantity")
     */
    private $basisQuantity;

    /**
     * @var Amount
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("BasisAmount")
     */
    private $basisAmount;

    /**
     * @var Amount
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ActualAmount")
     */
    private $actualAmount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ReasonCode")
     */
    private $reasonCode;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("Reason")
     */
    private $reason;

    /**
     * @var TradeTax[]
     * @JMS\Type("array<Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax>")
     * @JMS\XmlList(inline = true, entry = "CategoryTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $categoryTradeTaxes;

    /**
     * AllowanceCharge constructor.
     */
    public function __construct(bool $indicator, float $actualAmount, string $currency = 'EUR', bool $isSum = false)
    {
        $this->indicator = new Indicator($indicator);
        $this->actualAmount = new Amount($actualAmount, $currency, $isSum);
    }

    /**
     * @return bool
     */
    public function getIndicator()
    {
        return $this->indicator->getIndicator();
    }

    /**
     * @param bool $indicator
     *
     * @return self
     */
    public function setIndicator($indicator)
    {
        $this->indicator->setIndicator($indicator);
        return $this;
    }

    /**
     * @return Amount
     */
    public function getActualAmount()
    {
        return $this->actualAmount;
    }

    /**
     * @param Amount $actualAmount
     *
     * @return self
     */
    public function setActualAmount($actualAmount)
    {
        $this->actualAmount = $actualAmount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getReason()
    {
        return $this->reason;
    }

    public function setReason(string $reason): AllowanceCharge
    {
        $this->reason = $reason;
        return $this;
    }

    public function getCategoryTradeTaxes(): array
    {
        return $this->categoryTradeTaxes;
    }

    /**
     * @return self
     */
    public function addCategoryTradeTax(TradeTax $tradeTax)
    {
        $this->categoryTradeTaxes[] = $tradeTax;
        return $this;
    }

    /**
     * @return string
     */
    public function getSequenceNumeric()
    {
        return $this->sequenceNumeric;
    }

    /**
     * @return self
     */
    public function setSequenceNumeric(string $sequenceNumeric)
    {
        $this->sequenceNumeric = $sequenceNumeric;
        return $this;
    }

    /**
     * @return string
     */
    public function getCalculationPercent()
    {
        return $this->calculationPercent;
    }

    /**
     * @return self
     */
    public function setCalculationPercent(string $calculationPercent)
    {
        $this->calculationPercent = $calculationPercent;
        return $this;
    }

    /**
     * @return Quantity
     */
    public function getBasisQuantity()
    {
        return $this->basisQuantity;
    }

    /**
     * @return self
     */
    public function setBasisQuantity(Quantity $basisQuantity)
    {
        $this->basisQuantity = $basisQuantity;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * @return self
     */
    public function setBasisAmount(Amount $basisAmount)
    {
        $this->basisAmount = $basisAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @return self
     */
    public function setReasonCode(string $reasonCode)
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }
}
