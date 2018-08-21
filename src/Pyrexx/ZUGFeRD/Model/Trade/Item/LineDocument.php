<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use Pyrexx\ZUGFeRD\Model\Note;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LineDocument
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("LineID")
     */
    private $lineId;

    /**
     * @var Note[]
     * @Type("array<Pyrexx\ZUGFeRD\Model\Note>")
     * @XmlList(inline = true, entry = "IncludedNote", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $notes = array();

    /**
     * LineDocument constructor.
     *
     * @param string $lineId
     */
    public function __construct($lineId = '')
    {
        $this->lineId = $lineId;
    }

    /**
     * @return string
     */
    public function getLineId()
    {
        return $this->lineId;
    }

    /**
     * @param string $lineId
     *
     * @return self
     */
    public function setLineId($lineId)
    {
        $this->lineId = $lineId;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Note $note
     *
     * @return self
     */
    public function addNote(Note $note)
    {
        $this->notes[] = $note;
        return $this;
   }

}