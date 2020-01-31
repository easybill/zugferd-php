<?php

namespace Easybill\ZUGFeRD\ModelV2\Trade;

use Easybill\ZUGFeRD\ModelV2\Date;
use JMS\Serializer\Annotation as JMS;

class ReferencedDocument
{

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("IssuerAssignedID")
     */
    private $issuerAssignedID;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("URIID")
     */
    private $URIID;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("TypeCode")
     */
    private $typeCode;


    /**
     * ReferencedDocument constructor.
     *
          */
    public function __construct()
    {

    }

}