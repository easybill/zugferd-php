<?php namespace Pyrexx\ZUGFeRD\Model;

use Pyrexx\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AllowanceCharge
 *
 * @package Pyrexx\ZUGFeRD\Model
 */
class AllowanceCharge
{

    /**
     * @var Indicator
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Indicator")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ChargeIndicator")
     */
    private $indicator;

    /**
     * @var Amount
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ActualAmount")
     */
    private $actualAmount;

    /**
     * AllowanceCharge constructor.
     *
     * @param bool   $indicator
     * @param double $actualAmount
     * @param string $currency
     */
    public function __construct($indicator, $actualAmount, $currency = 'EUR')
    {
        $this->indicator = new Indicator($indicator);
        $this->actualAmount = new Amount($actualAmount, $currency, false);
    }

    /**
     * @return boolean
     */
    public function getIndicator()
    {
        return $this->indicator->getIndicator();
    }

    /**
     * @param boolean $indicator
     */
    public function setIndicator($indicator)
    {
        $this->indicator->setIndicator($indicator);
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Amount
     */
    public function getActualAmount()
    {
        return $this->actualAmount;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Amount $actualAmount
     */
    public function setActualAmount($actualAmount)
    {
        $this->actualAmount = $actualAmount;
    }

}