<?php namespace Pyrexx\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class Header
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ID")
     */
    private $id = '';

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Name")
     */
    private $name = '';

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TypeCode")
     */
    private $typeCode = '380';

    /**
     * @var Date
     * @Type("Pyrexx\ZUGFeRD\Model\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("IssueDateTime")
     */
    private $date;

    /**
     * @var Note[]
     * @Type("array<Pyrexx\ZUGFeRD\Model\Note>")
     * @XmlList(inline = true, entry = "IncludedNote", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $notes = array();

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = (string)$id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = (string)$name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * @param string $typeCode
     *
     * @return self
     */
    public function setTypeCode($typeCode)
    {
        $this->typeCode = (string)$typeCode;
        return $this;
    }


    /**
     * @param Note $note
     *
     * @return self
     */
    public function addNote(Note $note)
    {
        $this->notes[] = $note;
        return $this;
    }

    /**
     * @return Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Date $date
     *
     * @return self
     */
    public function setDate(Date $date)
    {
        $this->date = $date;

        return $this;
    }

}