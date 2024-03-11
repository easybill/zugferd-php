<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class PaymentMeans
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('TypeCode')]
    private $code;

    /**
     * @var string
     */
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('Information')]
    private $information;

    /**
     * @var CreditorFinancialAccount
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\CreditorFinancialAccount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('PayeePartyCreditorFinancialAccount')]
    private $payeeAccount;

    /**
     * @var CreditorFinancialInstitution
     */
    #[Type(\Easybill\ZUGFeRD\Model\Trade\CreditorFinancialInstitution::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('PayeeSpecifiedCreditorFinancialInstitution')]
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
     * @return self
     */
    public function setPayeeAccount(CreditorFinancialAccount $payeeAccount)
    {
        $this->payeeAccount = $payeeAccount;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\CreditorFinancialInstitution
     */
    public function getPayeeInstitution()
    {
        return $this->payeeInstitution;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\CreditorFinancialInstitution $payeeInstitution
     *
     * @return self
     */
    public function setPayeeInstitution($payeeInstitution)
    {
        $this->payeeInstitution = $payeeInstitution;
        return $this;
    }
}
