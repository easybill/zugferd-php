<?php


namespace Easybill\ZUGFeRD\Model\Trade\Tax;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class TradeTax
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class TradeTax
{
    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("CalculatedAmount")
     */
    private $calculatedAmount;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TypeCode")
     */
    private $code = '';

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BasisAmount")
     */
    private $basisAmount;

    /**
     * @var double
     * @Type("double")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ApplicablePercent")
     */
    private $percent = 0.0;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("CategoryCode")
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
        $this->percent = number_format($percent, 2);
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