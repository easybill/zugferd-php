<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use Easybill\ZUGFeRD\ModelV2\Note;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LineDocument
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("LineID")
     */
    private $lineId;

    /**
     * @var Note[]
     * @Type("array<Easybill\ZUGFeRD\ModelV2\Note>")
     * @XmlList(inline = true, entry = "IncludedNote", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\ModelV2\Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Note $note
     *
     * @return self
     */
    public function addNote(Note $note)
    {
        $this->notes[] = $note;
        return $this;
   }

}