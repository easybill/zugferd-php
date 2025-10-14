<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation as JMS;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class BillingPeriod
{
    public function __construct(#[JMS\Type(Date::class)]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('StartDateTime')]
        private Date $start, #[JMS\Type(Date::class)]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('EndDateTime')]
        private Date $end) {}

    /**
     * @return Date
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param Date $start
     * @return self
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return Date
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param Date $end
     * @return self
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }
}
