<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class Note
 */
class Note
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Content")
     */
    private $content = '';

    function __construct($content)
    {
        $this->setContent($content);
    }


    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = (string)$content;
        return $this;
    }
}