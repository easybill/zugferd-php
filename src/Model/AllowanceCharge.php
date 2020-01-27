<?php namespace Easybill\ZUGFeRD\Model;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AllowanceCharge
 *
 * @package Easybill\ZUGFeRD\Model
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

}