<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation as JMS;

class BillingPeriod
{
    public function __construct(#[JMS\Type(\Easybill\ZUGFeRD\Model\Date::class)]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('StartDateTime')]
        private Date $start, #[JMS\Type(\Easybill\ZUGFeRD\Model\Date::class)]
        #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[JMS\SerializedName('EndDateTime')]
        private Date $end)
    {
    }

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
