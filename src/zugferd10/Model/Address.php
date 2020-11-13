<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Address
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PostcodeCode")
     */
    private $postcode;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("LineOne")
     */
    private $lineOne;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("LineTwo")
     */
    private $lineTwo;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("CityName")
     */
    private $city;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("CountryID")
     */
    private $countryCode;

    /**
     * Address constructor.
     *
     * @param string $postcode
     * @param string $lineOne
     * @param string $lineTwo
     * @param string $city
     * @param string $countryCode
     */
    public function __construct($postcode = '', $lineOne = '', $lineTwo = '', $city = '', $countryCode = '')
    {
        $this->postcode = $postcode;
        $this->lineOne = $lineOne;
        $this->lineTwo = $lineTwo;
        $this->city = $city;
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getLineOne()
    {
        return $this->lineOne;
    }

    /**
     * @param string $lineOne
     */
    public function setLineOne($lineOne)
    {
        $this->lineOne = $lineOne;
    }

    /**
     * @return string
     */
    public function getLineTwo()
    {
        return $this->lineTwo;
    }

    /**
     * @param string $lineTwo
     */
    public function setLineTwo($lineTwo)
    {
        $this->lineTwo = $lineTwo;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }
}
