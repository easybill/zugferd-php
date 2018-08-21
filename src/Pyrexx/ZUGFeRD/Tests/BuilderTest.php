<?php

class BuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @before
     */
    public function setupAnnotationRegistry()
    {
        \Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            __DIR__ . '/../../../../vendor/jms/serializer/src');
    }

    public function testGetXML()
    {

        $zugferdXML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryDocument xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rsm="urn:ferd:CrossIndustryDocument:invoice:1p0" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15">
  <rsm:SpecifiedExchangedDocumentContext>
    <ram:GuidelineSpecifiedDocumentContextParameter>
      <ram:ID>urn:ferd:CrossIndustryDocument:invoice:1p0:comfort</ram:ID>
    </ram:GuidelineSpecifiedDocumentContextParameter>
  </rsm:SpecifiedExchangedDocumentContext>
  <rsm:HeaderExchangedDocument>
    <ram:ID>RE1337</ram:ID>
    <ram:Name>RECHNUNG</ram:Name>
    <ram:TypeCode>380</ram:TypeCode>
    <ram:IssueDateTime>
      <udt:DateTimeString format="102">20130305</udt:DateTimeString>
    </ram:IssueDateTime>
    <ram:IncludedNote>
      <ram:Content>Test Node 1</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Test Node 2</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Easybill GmbH
            Düsselstr. 21
            41564 Kaarst
            
            Geschäftsführer:
            Christian Szardenings
            Ronny Keyser</ram:Content>
      <ram:SubjectCode>REG</ram:SubjectCode>
    </ram:IncludedNote>
  </rsm:HeaderExchangedDocument>
  <rsm:SpecifiedSupplyChainTradeTransaction>
    <ram:ApplicableSupplyChainTradeAgreement>
      <ram:SellerTradeParty>
        <ram:Name>Lieferant GmbH</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>80333</ram:PostcodeCode>
          <ram:LineOne>Lieferantenstraße 20</ram:LineOne>
          <ram:CityName>München</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="FC">201/113/40209</ram:ID>
        </ram:SpecifiedTaxRegistration>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="VA">DE123456789</ram:ID>
        </ram:SpecifiedTaxRegistration>
      </ram:SellerTradeParty>
      <ram:BuyerTradeParty>
        <ram:Name>Kunden AG Mitte</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>69876</ram:PostcodeCode>
          <ram:LineOne>Hans Muster</ram:LineOne>
          <ram:LineTwo>Kundenstraße 15</ram:LineTwo>
          <ram:CityName>Frankfurt</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
      </ram:BuyerTradeParty>
    </ram:ApplicableSupplyChainTradeAgreement>
    <ram:ApplicableSupplyChainTradeDelivery>
      <ram:ActualDeliverySupplyChainEvent>
        <ram:OccurrenceDateTime>
          <udt:DateTimeString format="102">20130305</udt:DateTimeString>
        </ram:OccurrenceDateTime>
      </ram:ActualDeliverySupplyChainEvent>
    </ram:ApplicableSupplyChainTradeDelivery>
    <ram:ApplicableSupplyChainTradeSettlement>
      <ram:PaymentReference>2013-471102</ram:PaymentReference>
      <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
      <ram:SpecifiedTradeSettlementPaymentMeans>
        <ram:TypeCode>31</ram:TypeCode>
        <ram:Information>Überweisung</ram:Information>
        <ram:PayeePartyCreditorFinancialAccount>
          <ram:IBANID>DE08700901001234567890</ram:IBANID>
          <ram:AccountName></ram:AccountName>
          <ram:ProprietaryID></ram:ProprietaryID>
        </ram:PayeePartyCreditorFinancialAccount>
        <ram:PayeeSpecifiedCreditorFinancialInstitution>
          <ram:BICID>GENODEF1M04</ram:BICID>
          <ram:GermanBankleitzahlID></ram:GermanBankleitzahlID>
          <ram:Name></ram:Name>
        </ram:PayeeSpecifiedCreditorFinancialInstitution>
      </ram:SpecifiedTradeSettlementPaymentMeans>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">19.25</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">275.00</ram:BasisAmount>
        <ram:ApplicablePercent>7.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">37.62</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">198.00</ram:BasisAmount>
        <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:SpecifiedTradePaymentTerms>
        <ram:Description>Zahlbar innerhalb von 20 Tagen (bis zum 05.10.2016) unter Abzug von 3% Skonto (Zahlungsbetrag = 1.766,03 €). Bis zum 29.09.2016 ohne Abzug.</ram:Description>
        <ram:DueDateDateTime>
          <udt:DateTimeString format="102">20130404</udt:DateTimeString>
        </ram:DueDateDateTime>
      </ram:SpecifiedTradePaymentTerms>
      <ram:SpecifiedTradeSettlementMonetarySummation>
        <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        <ram:ChargeTotalAmount currencyID="EUR">0.00</ram:ChargeTotalAmount>
        <ram:AllowanceTotalAmount currencyID="EUR">0.00</ram:AllowanceTotalAmount>
        <ram:TaxBasisTotalAmount currencyID="EUR">198.00</ram:TaxBasisTotalAmount>
        <ram:TaxTotalAmount currencyID="EUR">37.62</ram:TaxTotalAmount>
        <ram:GrandTotalAmount currencyID="EUR">235.62</ram:GrandTotalAmount>
        <ram:DuePayableAmount currencyID="EUR">235.62</ram:DuePayableAmount>
      </ram:SpecifiedTradeSettlementMonetarySummation>
    </ram:ApplicableSupplyChainTradeSettlement>
    <ram:IncludedSupplyChainTradeLineItem>
      <ram:AssociatedDocumentLineDocument>
        <ram:LineID>1</ram:LineID>
        <ram:IncludedNote>
          <ram:Content>Testcontent in einem LineDocument</ram:Content>
        </ram:IncludedNote>
      </ram:AssociatedDocumentLineDocument>
      <ram:SpecifiedSupplyChainTradeAgreement>
        <ram:GrossPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.9000</ram:ChargeAmount>
          <ram:AppliedTradeAllowanceCharge>
            <ram:ChargeIndicator>
              <udt:Indicator>false</udt:Indicator>
            </ram:ChargeIndicator>
            <ram:ActualAmount currencyID="EUR">1.8000</ram:ActualAmount>
          </ram:AppliedTradeAllowanceCharge>
        </ram:GrossPriceProductTradePrice>
        <ram:NetPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.9000</ram:ChargeAmount>
        </ram:NetPriceProductTradePrice>
      </ram:SpecifiedSupplyChainTradeAgreement>
      <ram:SpecifiedSupplyChainTradeDelivery>
        <ram:BilledQuantity unitCode="C62">20.0000</ram:BilledQuantity>
      </ram:SpecifiedSupplyChainTradeDelivery>
      <ram:SpecifiedSupplyChainTradeSettlement>
        <ram:ApplicableTradeTax>
          <ram:TypeCode>VAT</ram:TypeCode>
          <ram:CategoryCode>S</ram:CategoryCode>
          <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
        </ram:ApplicableTradeTax>
        <ram:SpecifiedTradeSettlementMonetarySummation>
          <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        </ram:SpecifiedTradeSettlementMonetarySummation>
      </ram:SpecifiedSupplyChainTradeSettlement>
      <ram:SpecifiedTradeProduct>
        <ram:SellerAssignedID>TB100A4</ram:SellerAssignedID>
        <ram:Name>Trennblätter A4</ram:Name>
      </ram:SpecifiedTradeProduct>
    </ram:IncludedSupplyChainTradeLineItem>
  </rsm:SpecifiedSupplyChainTradeTransaction>
</rsm:CrossIndustryDocument>

XML;
        $doc = new \Pyrexx\ZUGFeRD\Model\Document(\Pyrexx\ZUGFeRD\Model\Document::TYPE_COMFORT);
        $doc->getHeader()
            ->setId('RE1337')
            ->setName('RECHNUNG')
            ->setDate(new \Pyrexx\ZUGFeRD\Model\Date(new \DateTime('20130305'), 102))
            ->addNote(new \Pyrexx\ZUGFeRD\Model\Note('Test Node 1'))
            ->addNote(new \Pyrexx\ZUGFeRD\Model\Note('Test Node 2'))
            ->addNote(new \Pyrexx\ZUGFeRD\Model\Note('Easybill GmbH
            Düsselstr. 21
            41564 Kaarst
            
            Geschäftsführer:
            Christian Szardenings
            Ronny Keyser', 'REG'));


        $trade = $doc->getTrade();

        $trade->setDelivery(new \Pyrexx\ZUGFeRD\Model\Trade\Delivery('20130305', 102));

        $this->setAgreement($trade);
        $this->setLineItem($trade);
        $this->setSettlement($trade);

        $builder = \Pyrexx\ZUGFeRD\Builder::create();
        $xml = $builder->getXML($doc);

        $this->assertSame($zugferdXML, $xml);

        \Pyrexx\ZUGFeRD\SchemaValidator::isValid($xml);
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Trade $trade
     */
    private function setAgreement(\Pyrexx\ZUGFeRD\Model\Trade\Trade $trade)
    {
        $trade->getAgreement()
            ->setSeller(
                new \Pyrexx\ZUGFeRD\Model\Trade\TradeParty('Lieferant GmbH',
                    new \Pyrexx\ZUGFeRD\Model\Address('80333', 'Lieferantenstraße 20', null, 'München', 'DE'),
                    array(
                        new \Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration('FC', '201/113/40209'),
                        new \Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration('VA', 'DE123456789')
                    )
                )
            )->setBuyer(
                new \Pyrexx\ZUGFeRD\Model\Trade\TradeParty('Kunden AG Mitte',
                    new \Pyrexx\ZUGFeRD\Model\Address('69876', 'Hans Muster', 'Kundenstraße 15', 'Frankfurt', 'DE')
                )
            );
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Trade $trade
     */
    private function setLineItem(\Pyrexx\ZUGFeRD\Model\Trade\Trade $trade)
    {
        $tradeAgreement = new \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement();

        $grossPrice = new \Pyrexx\ZUGFeRD\Model\Trade\Item\Price(9.90, 'EUR', false);
        $grossPrice
            ->addAllowanceCharge(new \Pyrexx\ZUGFeRD\Model\AllowanceCharge(false, 1.80));

        $tradeAgreement->setGrossPrice($grossPrice);
        $tradeAgreement->setNetPrice(new \Pyrexx\ZUGFeRD\Model\Trade\Item\Price(9.90, 'EUR', false));

        $lineItemTradeTax = new \Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax();
        $lineItemTradeTax->setCode('VAT');
        $lineItemTradeTax->setPercent(19.00);
        $lineItemTradeTax->setCategory('S');

        $lineItemSettlement = new \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement();
        $lineItemSettlement
            ->setTradeTax($lineItemTradeTax)
            ->setMonetarySummation(new \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeMonetarySummation(198.00));

        $lineItem = new \Pyrexx\ZUGFeRD\Model\Trade\Item\LineItem();
        $lineItem
            ->setTradeAgreement($tradeAgreement)
            ->setDelivery(new \Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery(new \Pyrexx\ZUGFeRD\Model\Trade\Item\Quantity('C62', 20.00)))
            ->setSettlement($lineItemSettlement)
            ->setProduct(new \Pyrexx\ZUGFeRD\Model\Trade\Item\Product('TB100A4', 'Trennblätter A4'))
            ->setLineDocument(new \Pyrexx\ZUGFeRD\Model\Trade\Item\LineDocument('1'))
            ->getLineDocument()
            ->addNote(new \Pyrexx\ZUGFeRD\Model\Note('Testcontent in einem LineDocument'));

        $trade->addLineItem($lineItem);
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Trade $trade
     */
    private function setSettlement(\Pyrexx\ZUGFeRD\Model\Trade\Trade $trade)
    {
        $settlement = new \Pyrexx\ZUGFeRD\Model\Trade\Settlement('2013-471102', 'EUR');
        $settlement->setPaymentTerms(new \Pyrexx\ZUGFeRD\Model\Trade\PaymentTerms('Zahlbar innerhalb von 20 Tagen (bis zum 05.10.2016) unter Abzug von 3% Skonto (Zahlungsbetrag = 1.766,03 €). Bis zum 29.09.2016 ohne Abzug.', new \Pyrexx\ZUGFeRD\Model\Date('20130404')));

        $settlement->setPaymentMeans(new \Pyrexx\ZUGFeRD\Model\Trade\PaymentMeans());
        $settlement->getPaymentMeans()
            ->setCode('31')
            ->setInformation('Überweisung')
            ->setPayeeAccount(new \Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialAccount('DE08700901001234567890', '', ''))
            ->setPayeeInstitution(new \Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialInstitution('GENODEF1M04', '', ''));

        $tradeTax = new \Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax();
        $tradeTax->setCode('VAT');
        $tradeTax->setPercent(7.00);
        $tradeTax->setBasisAmount(new \Pyrexx\ZUGFeRD\Model\Trade\Amount(275.00, 'EUR'));
        $tradeTax->setCalculatedAmount(new \Pyrexx\ZUGFeRD\Model\Trade\Amount(19.25, 'EUR'));

        $tradeTax2 = new \Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax();
        $tradeTax2->setCode('VAT');
        $tradeTax2->setPercent(19.00);
        $tradeTax2->setBasisAmount(new \Pyrexx\ZUGFeRD\Model\Trade\Amount(198.00, 'EUR'));
        $tradeTax2->setCalculatedAmount(new \Pyrexx\ZUGFeRD\Model\Trade\Amount(37.62, 'EUR'));

        $settlement
            ->addTradeTax($tradeTax)
            ->addTradeTax($tradeTax2)
            ->setMonetarySummation(
                new \Pyrexx\ZUGFeRD\Model\Trade\MonetarySummation(198.00, 0.00, 0.00, 198.00, 37.62, 235.62, 235.62, 'EUR')
            );

        $trade->setSettlement($settlement);
    }

}
