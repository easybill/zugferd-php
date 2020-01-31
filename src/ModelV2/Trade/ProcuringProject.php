<?php

namespace Easybill\ZUGFeRD\ModelV2\Trade;

use Easybill\ZUGFeRD\ModelV2\Date;
use JMS\Serializer\Annotation as JMS;

class ProcuringProject
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ID")
     */
    private $id;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("Name")
     */
    private $name;




    /**
     * ReferencedDocument constructor.
     *
          */
    public function __construct()
    {

    }

}