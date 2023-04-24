<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * Class Note.
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

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SubjectCode")
     */
    private $subjectCode;

    /**
     * Note constructor.
     *
     * @param mixed $content
     * @param null|string $subjectCode
     */
    public function __construct($content, $subjectCode = null)
    {
        $this->setContent($content);
        $this->setSubjectCode($subjectCode);
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

    /**
     * @return string
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * @param string|null $subjectCode
     */
    public function setSubjectCode($subjectCode)
    {
        if ($subjectCode !== null
            && strlen($subjectCode) > 0
            && $subjectCode !== 'REG'
            && $subjectCode !== 'AAK'
            && $subjectCode !== 'AAJ'
            && $subjectCode !== 'PMT'
        ) {
            throw new \RuntimeException('Invalid subject code! Please set it to null or to an empty string, REG, AAK, AAJ, PMT or ');
        }

        $this->subjectCode = $subjectCode;
    }
}
