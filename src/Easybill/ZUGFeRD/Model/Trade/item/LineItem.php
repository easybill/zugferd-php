<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Note;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class LineItem
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class LineItem
{

    /**
     * @var LineDocument
     * @Type("Easybill\ZUGFeRD\Model\Trade\Item\LineDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("AssociatedDocumentLineDocument")
     */
    private $lineDocument;

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Item\LineDocument
     */
    public function getLineDocument()
    {
        return $this->lineDocument;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Item\LineDocument $lineDocument
     *
     * @return self
     */
    public function setLineDocument(LineDocument $lineDocument)
    {
        $this->lineDocument = $lineDocument;
        return $this;
    }

}