<?php

namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\Date;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Groups;

class PaymentTerms
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Description")
     * @Groups({"EN16931", "extended"})
     */
    private $description;

    /**
     * @var Date
     * @Type("Easybill\ZUGFeRD\Model\v21\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("DueDateDateTime")
     */
    private $dueDate;

    /**
     * PaymentTerms constructor.
     *
     * @param string $description
     * @param \Easybill\ZUGFeRD\Model\v21\Date $dueDate
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
     * @return \Easybill\ZUGFeRD\Model\v21\Date
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Date $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

}