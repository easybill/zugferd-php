<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\Groups;

class PaymentMeans
{
    /**
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    private $code;

    /**
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Information")
     * @Groups({"EN16931", "extended"})
     */
    private $information;

    /**
     *
     * @var CreditorFinancialAccount
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialAccount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeePartyCreditorFinancialAccount")
     */
    private $payeeAccount;

    /**
     * @var CreditorFinancialInstitution
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialInstitution")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeeSpecifiedCreditorFinancialInstitution")
     * @Groups({"EN16931", "extended"})
     */
    private $payeeInstitution;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
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
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialInstitution
     */
    public function getPayeeInstitution()
    {
        return $this->payeeInstitution;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialInstitution $payeeInstitution
     *
     * @return self
     */
    public function setPayeeInstitution($payeeInstitution)
    {
        $this->payeeInstitution = $payeeInstitution;
        return $this;
    }

}