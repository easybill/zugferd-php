<?php namespace Pyrexx\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class PaymentMeans
{
    /**
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TypeCode")
     */
    private $code = '';

    /**
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Information")
     */
    private $information = '';

    /**
     *
     * @var CreditorFinancialAccount
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialAccount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PayeePartyCreditorFinancialAccount")
     */
    private $payeeAccount;


    /**
     *
     * @var CreditorFinancialInstitution
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialInstitution")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PayeeSpecifiedCreditorFinancialInstitution")
     */
    private $payeeInstitution;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param string $information
     *
     * @return self
     */
    public function setInformation($information)
    {
        $this->information = $information;
        return $this;
    }

    /**
     * @return CreditorFinancialAccount
     */
    public function getPayeeAccount()
    {
        return $this->payeeAccount;
    }

    /**
     * @param CreditorFinancialAccount $payeeAccount
     *
     * @return self
     */
    public function setPayeeAccount(CreditorFinancialAccount $payeeAccount)
    {
        $this->payeeAccount = $payeeAccount;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialInstitution
     */
    public function getPayeeInstitution()
    {
        return $this->payeeInstitution;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialInstitution $payeeInstitution
     *
     * @return self
     */
    public function setPayeeInstitution($payeeInstitution)
    {
        $this->payeeInstitution = $payeeInstitution;
        return $this;
    }


}