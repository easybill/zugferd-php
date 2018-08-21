<?php

namespace Pyrexx\ZUGFeRD\Model\Trade;

use Pyrexx\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation as JMS;

class PaymentTerms
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("Description")
     */
    private $description;

    /**
     * @var Date
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Date")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("DueDateDateTime")
     */
    private $dueDate;

    /**
     * PaymentTerms constructor.
     *
     * @param string                       $description
     * @param \Pyrexx\ZUGFeRD\Model\Date $dueDate
     */
    public function __construct($description, Date $dueDate)
    {
        $this->description = $description;
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Date
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Date $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

}