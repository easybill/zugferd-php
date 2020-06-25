<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Groups;

class CreditorFinancialAccount
{

    /**
     * IBAN (International Bank Account Number) of the bank account.
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("IBANID")
     */
    private $iban;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("AccountName")
     * @Groups({"EN16931", "extended"})
     */
    private $accountName;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ProprietaryID")
     */
    private $proprietary;

    /**
     * CreditorFinancialAccount constructor.
     *
     * @param string $iban
     * @param string $accountName
     * @param string $proprietary
     */
    public function __construct($iban, $accountName, $proprietary)
    {
        $this->iban = $iban;
        $this->accountName = $accountName;
        $this->proprietary = $proprietary;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     * @return string
     */
    public function getProprietary()
    {
        return $this->proprietary;
    }

    /**
     * @param string $proprietary
     */
    public function setProprietary($proprietary)
    {
        $this->proprietary = $proprietary;
    }

}