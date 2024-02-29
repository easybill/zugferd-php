<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Note;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

#[AccessorOrder(order: 'custom', custom: ['lineId', 'notes'])]
class LineDocument
{
    /**
     * @var Note[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\Note>')]
    #[XmlList(entry: 'IncludedNote', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    private $notes = [];

    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('LineID')]
        private string $lineId = '')
    {
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
     * @return \Easybill\ZUGFeRD\Model\Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return self
     */
    public function addNote(Note $note)
    {
        $this->notes[] = $note;
        return $this;
    }
}
