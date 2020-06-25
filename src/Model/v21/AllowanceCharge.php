<?php namespace Easybill\ZUGFeRD\Model\v21;

use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * Class AllowanceCharge
 *
 * @package Easybill\ZUGFeRD\Model
 */
class AllowanceCharge
{

    /**
     * @var Indicator
     * @Type("Easybill\ZUGFeRD\Model\v21\Indicator")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ChargeIndicator")
     */
    private $indicator;

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Amount")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ActualAmount")
     */
    private $actualAmount;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ReasonCode")
     */
    private $reasonCode;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Reason")
     */
    private $reason;

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax>")
     * @XmlList(inline = true, entry = "CategoryTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    private $categoryTradeTaxes;

    /**
     * AllowanceCharge constructor.
     *
     * @param bool $indicator
     * @param double $actualAmount
     * @param string $currency
     * @param bool $isSum
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

    /**
     * @param string $reason
     *
     * @return AllowanceCharge
     */
    public function setReason(string $reason): AllowanceCharge
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategoryTradeTaxes(): array
    {
        return $this->categoryTradeTaxes;
    }

    /**
     * @param TradeTax $tradeTax
     *
     * @return self
     */
    public function addCategoryTradeTax(TradeTax $tradeTax)
    {
        $this->categoryTradeTaxes[] = $tradeTax;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @param string $reasonCode
     *
     * @return AllowanceCharge
     */
    public function setReasonCode(string $reasonCode): AllowanceCharge
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }

}