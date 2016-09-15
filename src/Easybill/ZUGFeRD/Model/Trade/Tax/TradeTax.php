<?php


namespace Easybill\ZUGFeRD\Model\Trade\Tax;

use Easybill\ZUGFeRD\Model\Trade\Amount;

use JMS\Serializer\Annotation as JMS;

/**
 * Class TradeTax
 * 
 * @JMS\AccessorOrder("custom", custom = {"calculatedAmount", "code", "basisAmount", "category", "percent"})
 * 
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class TradeTax
{
    /**
     * @var Amount
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("CalculatedAmount")
     */
    private $calculatedAmount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("TypeCode")
     */
    private $code = '';

    /**
     * @var Amount
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("BasisAmount")
     */
    private $basisAmount;

    /**
     * @var double
     * @JMS\Type("double")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ApplicablePercent")
     */
    private $percent = 0.0;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("CategoryCode")
     */
    private $category;

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Amount
     */
    public function getCalculatedAmount()
    {
        return $this->calculatedAmount;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Amount $calculatedAmount
     */
    public function setCalculatedAmount($calculatedAmount)
    {
        $this->calculatedAmount = $calculatedAmount;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Amount
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Amount $basisAmount
     */
    public function setBasisAmount($basisAmount)
    {
        $this->basisAmount = $basisAmount;
    }

    /**
     * @return float
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     */
    public function setPercent($percent)
    {
        $this->percent = doubleval($percent);
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}