<?php

namespace Easybill\ZUGFeRD\Model\Trade;


use Easybill\ZUGFeRD\Model\CreditorFinancialAccount;

use Easybill\ZUGFeRD\Model\CreditorFinancialInstitution;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class PaymentMeans
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
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
     * @Type("Easybill\ZUGFeRD\Model\CreditorFinancialAccount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PayeePartyCreditorFinancialAccount")
     */
    private $payeeAccount;


    /**
     *
     * @var CreditorFinancialInstitution
     * @Type("Easybill\ZUGFeRD\Model\CreditorFinancialInstitution")
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
     * @return \Easybill\ZUGFeRD\Model\CreditorFinancialAccount
     */
    public function getPayeeAccount()
    {
        return $this->payeeAccount;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\CreditorFinancialAccount $payeeAccount
     *
     * @return self
     */
    public function setPayeeAccount(CreditorFinancialAccount $payeeAccount)
    {
        $this->payeeAccount = $payeeAccount;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\CreditorFinancialInstitution
     */
    public function getPayeeInstitution()
    {
        return $this->payeeInstitution;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\CreditorFinancialInstitution $payeeInstitution
     *
     * @return self
     */
    public function setPayeeInstitution($payeeInstitution)
    {
        $this->payeeInstitution = $payeeInstitution;
        return $this;
    }


}