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
class TradeTaxItem extends TradeTax
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ExemptionReason")
     * @Groups({"extended"})
     */
    private $exemptionReason = '';

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ExemptionReasonCode")
     * @Groups({"extended"})
     */
    private $exemptionReasonCode = '';

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