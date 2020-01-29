<?php

namespace Easybill\ZUGFeRD\ModelV2\Trade;

use Easybill\ZUGFeRD\ModelV2\Date;
use JMS\Serializer\Annotation as JMS;

class BillingPeriod
{

    /**
     * @var Date
     * @JMS\Type("Easybill\ZUGFeRD\ModelV2\Date")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("StartDateTime")
     */
    private $start;

    /**
     * @var Date
     * @JMS\Type("Easybill\ZUGFeRD\ModelV2\Date")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("EndDateTime")
     */
    private $end;

    /**
     * @param Date $start
     * @param Date $end
     */
    public function __construct(Date $start, Date $end)
    {
        $this->start = $start;
        $this->end = $end;
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
