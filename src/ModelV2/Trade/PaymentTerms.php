<?php

namespace Easybill\ZUGFeRD\ModelV2\Trade;

use Easybill\ZUGFeRD\ModelV2\Date;
use JMS\Serializer\Annotation as JMS;

class PaymentTerms
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("Description")
     */
    private $description;

    /**
     * @var Date
     * @JMS\Type("Easybill\ZUGFeRD\ModelV2\Date")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DueDateDateTime")
     */
    private $dueDate;

    /**
     * PaymentTerms constructor.
     *
     * @param string                       $description
     * @param \Easybill\ZUGFeRD\ModelV2\Date $dueDate
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
     * @return \Easybill\ZUGFeRD\ModelV2\Date
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Date $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

}