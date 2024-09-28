<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation as JMS;

class PaymentTerms
{
    /**
     * PaymentTerms constructor.
     *
     * @param string $description
     */
    public function __construct(#[JMS\Type('string')]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('Description')]
        private $description, #[JMS\Type(Date::class)]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('DueDateDateTime')]
        private Date $dueDate) {}

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
     * @return Date
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param Date $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }
}
