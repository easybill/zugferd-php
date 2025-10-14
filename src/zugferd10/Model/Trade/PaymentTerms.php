<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation as JMS;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
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
