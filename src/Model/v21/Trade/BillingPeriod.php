<?php

namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\Date;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class BillingPeriod
{

    /**
     * @var Date
     * @Type("Easybill\ZUGFeRD\Model\v21\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("StartDateTime")
     */
    private $start;

    /**
     * @var Date
     * @Type("Easybill\ZUGFeRD\Model\v21\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("EndDateTime")
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
