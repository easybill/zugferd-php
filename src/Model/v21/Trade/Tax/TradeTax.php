<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Tax;

use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Groups;

/**
 * @AccessorOrder("custom", custom = {"calculatedAmount", "code", "exemptionReason", "basisAmount", "category", "exemptionReasonCode", "percent"})
 */
class TradeTax
{
    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("CalculatedAmount")
     */
    private $calculatedAmount;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    private $code = '';

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BasisAmount")
     */
    private $basisAmount;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ExemptionReason")
     */
    private $exemptionReason = '';

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("CategoryCode")
     */
    private $category;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ExemptionReasonCode")
     */
    private $exemptionReasonCode = '';

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("RateApplicablePercent")
     */
    private $percent;

//* @Groups({"extended"})


    /**
     * @return Amount
     */
    public function getCalculatedAmount()
    {
        return $this->calculatedAmount;
    }

    /**
     * @param Amount $calculatedAmount
     * @return self
     */
    public function setCalculatedAmount($calculatedAmount)
    {
        $this->calculatedAmount = $calculatedAmount;
        return $this;
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
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return null|\Easybill\ZUGFeRD\Model\Trade\Amount
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * @param Amount $basisAmount
     *
     * @return \Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax
     */
    public function setBasisAmount($basisAmount)
    {
//        error_log(print_r($basisAmount, true));
        $this->basisAmount = $basisAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param string $percent
     * @return self
     */
    public function setPercent($percent)
    {
        $this->percent = number_format($percent, 2, '.', '');

        return $this;
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
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getExemptionReason()
    {
        return $this->exemptionReason;
    }

    /**
     * @param string $exemptionReason
     * @return self
     */
    public function setExemptionReason($exemptionReason)
    {
        $this->exemptionReason = $exemptionReason;
        return $this;
    }

    /**
     * @return string
     */
    public function getExemptionReasonCode()
    {
        return $this->exemptionReasonCode;
    }

    /**
     * @param string $exemptionReasonCode
     * @return self
     */
    public function setExemptionReasonCode($exemptionReasonCode)
    {
        $this->exemptionReasonCode = $exemptionReasonCode;
        return $this;
    }

}