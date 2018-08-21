<?php

class ReaderTest extends \PHPUnit_Framework_TestCase
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

    public function testGetDocument()
    {

        $zugferdXML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryDocument xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rsm="urn:ferd:CrossIndustryDocument:invoice:1p0" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15">
  <rsm:SpecifiedExchangedDocumentContext>
    <ram:GuidelineSpecifiedDocumentContextParameter>
      <ram:ID>urn:ferd:CrossIndustryDocument:invoice:1p0:basic</ram:ID>
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
        <ram:Description>Zahlbar innerhalb 30 Tagen netto bis 04.04.2013, 3% Skonto innerhalb 10 Tagen bis 15.03.2013</ram:Description>
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
          <ram:ChargeAmount currencyID="EUR">9.90</ram:ChargeAmount>
          <ram:AppliedTradeAllowanceCharge>
            <ram:ChargeIndicator>
              <udt:Indicator>false</udt:Indicator>
            </ram:ChargeIndicator>
            <ram:ActualAmount currencyID="EUR">1.8000</ram:ActualAmount>
          </ram:AppliedTradeAllowanceCharge>
        </ram:GrossPriceProductTradePrice>
        <ram:NetPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.90</ram:ChargeAmount>
        </ram:NetPriceProductTradePrice>
      </ram:SpecifiedSupplyChainTradeAgreement>
      <ram:SpecifiedSupplyChainTradeDelivery>
        <ram:BilledQuantity unitCode="C62">20.0000</ram:BilledQuantity>
      </ram:SpecifiedSupplyChainTradeDelivery>
      <ram:SpecifiedSupplyChainTradeSettlement>
        <ram:ApplicableTradeTax>
          <ram:TypeCode>VAT</ram:TypeCode>
          <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
          <ram:CategoryCode>S</ram:CategoryCode>
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


        $reader = \Pyrexx\ZUGFeRD\Reader::create();

        $doc = $reader->getDocument($zugferdXML);
        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Document', $doc);

        $this->checkHeader($doc->getHeader());
        $this->checkTrade($doc->getTrade());
    }

    private function checkHeader(\Pyrexx\ZUGFeRD\Model\Header $header)
    {
        $this->assertSame('RE1337', $header->getId());
        $this->assertSame('RECHNUNG', $header->getName());
        $this->assertSame('380', $header->getTypeCode());

        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Date', $header->getDate());
        $this->assertSame(102, $header->getDate()->getFormat());
        $this->assertSame('20130305', $header->getDate()->getDate());

        $notes = $header->getNotes();
        $this->assertCount(3, $notes);

        $cnt = 0;
        foreach ($notes as $note) {
            $cnt++;
            $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Note', $note);

            if ($cnt === 3) {
                $this->assertSame('Easybill GmbH
            Düsselstr. 21
            41564 Kaarst
            
            Geschäftsführer:
            Christian Szardenings
            Ronny Keyser', $note->getContent());
                $this->assertSame('REG', $note->getSubjectCode());

            } else {
                $this->assertSame('Test Node ' . $cnt, $note->getContent());
            }
        }
    }

    private function checkTrade(\Pyrexx\ZUGFeRD\Model\Trade\Trade $trade)
    {
        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Trade\Trade', $trade);

        $this->checkAgreement($trade->getAgreement());
        $this->checkTradeSettlement($trade->getSettlement());

        $delivery = $trade->getDelivery();
        $this->assertSame(102, $delivery->getChainEvent()->getDate()->getFormat());
        $this->assertSame('20130305', $delivery->getChainEvent()->getDate()->getDate());

        $lineItems = $trade->getLineItems();
        $this->assertCount(1, $lineItems);
        $this->checkLineItem($lineItems[0]);
    }

    private function checkAgreement(\Pyrexx\ZUGFeRD\Model\Trade\Agreement $agreement)
    {
        $seller = $agreement->getSeller();
        $buyer = $agreement->getBuyer();
        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Trade\Agreement', $agreement);
        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Trade\TradeParty', $seller);
        $this->assertInstanceOf('\Pyrexx\ZUGFeRD\Model\Trade\TradeParty', $buyer);

        $sellerAddress = $seller->getAddress();
        $this->assertSame('Lieferant GmbH', $seller->getName());
        $this->assertSame('80333', $sellerAddress->getPostcode());
        $this->assertSame('München', $sellerAddress->getCity());
        $this->assertSame('Lieferantenstraße 20', $sellerAddress->getLineOne());
        $this->assertSame('DE', $sellerAddress->getCountryCode());

        $sellerRegistrations = $seller->getTaxRegistrations();
        $this->assertCount(2, $sellerRegistrations);

        for ($cnt = 0; $cnt < 2; $cnt++) {
            $taxRegistration = $sellerRegistrations[$cnt];
            if ($cnt == 0) {
                $this->assertSame('FC', $taxRegistration->getRegistration()->getSchemeID());
                $this->assertSame('201/113/40209', $taxRegistration->getRegistration()->getValue());
            } else {
                $this->assertSame('VA', $taxRegistration->getRegistration()->getSchemeID());
                $this->assertSame('DE123456789', $taxRegistration->getRegistration()->getValue());
            }
        }

        $buyerAddress = $buyer->getAddress();
        $this->assertSame('Kunden AG Mitte', $buyer->getName());
        $this->assertSame('69876', $buyerAddress->getPostcode());
        $this->assertSame('Frankfurt', $buyerAddress->getCity());
        $this->assertSame('Hans Muster', $buyerAddress->getLineOne());
        $this->assertSame('Kundenstraße 15', $buyerAddress->getLineTwo());
        $this->assertSame('DE', $buyerAddress->getCountryCode());
        $this->assertEmpty($buyer->getTaxRegistrations());
    }

    private function checkTradeSettlement(\Pyrexx\ZUGFeRD\Model\Trade\Settlement $settlement)
    {
        $this->assertSame('2013-471102', $settlement->getPaymentReference());
        $this->assertSame('EUR', $settlement->getCurrency());

        $paymentMeans = $settlement->getPaymentMeans();
        $this->assertSame('31', $paymentMeans->getCode());
        $this->assertSame('Überweisung', $paymentMeans->getInformation());

        $payeeAccount = $paymentMeans->getPayeeAccount();
        $this->assertSame('DE08700901001234567890', $payeeAccount->getIban());
        $this->assertEmpty($payeeAccount->getAccountName());
        $this->assertEmpty($payeeAccount->getProprietary());

        $payeeInstitution = $paymentMeans->getPayeeInstitution();
        $this->assertSame('GENODEF1M04', $payeeInstitution->getBic());
        $this->assertEmpty($payeeInstitution->getGermanBLZ());
        $this->assertEmpty($payeeInstitution->getName());

        $tradeTaxes = $settlement->getTradeTaxes();
        $this->assertCount(2, $tradeTaxes);

        $tradeTax1 = $tradeTaxes[0];
        $tradeTax2 = $tradeTaxes[1];
        $this->assertSame('EUR', $tradeTax1->getCalculatedAmount()->getCurrency());
        $this->assertSame(19.25, $tradeTax1->getCalculatedAmount()->getValue());
        $this->assertSame('VAT', $tradeTax1->getCode());
        $this->assertSame('EUR', $tradeTax1->getBasisAmount()->getCurrency());
        $this->assertSame(275.00, $tradeTax1->getBasisAmount()->getValue());
        $this->assertSame(7.00, $tradeTax1->getPercent());

        $this->assertSame('EUR', $tradeTax2->getCalculatedAmount()->getCurrency());
        $this->assertSame(37.62, $tradeTax2->getCalculatedAmount()->getValue());
        $this->assertSame('VAT', $tradeTax2->getCode());
        $this->assertSame('EUR', $tradeTax2->getBasisAmount()->getCurrency());
        $this->assertSame(198.00, $tradeTax2->getBasisAmount()->getValue());
        $this->assertSame(19.00, $tradeTax2->getPercent());

        $monetarySummation = $settlement->getMonetarySummation();
        $this->assertSame(198.00, $monetarySummation->getLineTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getLineTotal()->getCurrency());

        $this->assertSame(0.00, $monetarySummation->getChargeTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getChargeTotal()->getCurrency());

        $this->assertSame(0.00, $monetarySummation->getAllowanceTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getAllowanceTotal()->getCurrency());

        $this->assertSame(198.00, $monetarySummation->getTaxBasisTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getTaxBasisTotal()->getCurrency());

        $this->assertSame(37.62, $monetarySummation->getTaxTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getTaxTotal()->getCurrency());

        $this->assertSame(235.62, $monetarySummation->getGrandTotal()->getValue());
        $this->assertSame('EUR', $monetarySummation->getGrandTotal()->getCurrency());

        $paymentTerms = $settlement->getPaymentTerms();
        $this->assertSame('Zahlbar innerhalb 30 Tagen netto bis 04.04.2013, 3% Skonto innerhalb 10 Tagen bis 15.03.2013', $paymentTerms->getDescription());
        $this->assertSame('20130404', $paymentTerms->getDueDate()->getDate());
        $this->assertSame(102, $paymentTerms->getDueDate()->getFormat());
    }

    private function checkLineItem(\Pyrexx\ZUGFeRD\Model\Trade\Item\LineItem $lineItem)
    {
        $lineDocument = $lineItem->getLineDocument();
        $lineDocumentNotes = $lineDocument->getNotes();
        $this->assertSame('1', $lineDocument->getLineId());
        $this->assertCount(1, $lineDocumentNotes);
        $this->assertSame('Testcontent in einem LineDocument', $lineDocumentNotes[0]->getContent());

        $agreement = $lineItem->getTradeAgreement();
        $grossPrice = $agreement->getGrossPrice();

        $this->assertSame(9.90, $grossPrice->getAmount()->getValue());
        $this->assertSame('EUR', $grossPrice->getAmount()->getCurrency());

        $grossPriceAllowanceCharges = $grossPrice->getAllowanceCharges();
        $this->assertCount(1, $grossPriceAllowanceCharges);

        $allowanceCharge = $grossPriceAllowanceCharges[0];
        $this->assertFalse($allowanceCharge->getIndicator());
        $this->assertSame('EUR', $allowanceCharge->getActualAmount()->getCurrency());
        $this->assertSame(1.80, $allowanceCharge->getActualAmount()->getValue());

        $this->assertSame(9.90, $agreement->getNetPrice()->getAmount()->getValue());
        $this->assertSame('EUR', $agreement->getNetPrice()->getAmount()->getCurrency());

        $this->assertSame('C62', $lineItem->getDelivery()->getBilledQuantity()->getUnitCode());
        $this->assertSame(20.0000, $lineItem->getDelivery()->getBilledQuantity()->getValue());

        $settlement = $lineItem->getSettlement();
        $tradeTax = $settlement->getTradeTax();
        $this->assertSame('VAT', $tradeTax->getCode());
        $this->assertSame(19.00, $tradeTax->getPercent());
        $this->assertSame('S', $tradeTax->getCategory());

        $monetarySummationTotal = $settlement->getMonetarySummation()->getTotalAmount();
        $this->assertSame(198.00, $monetarySummationTotal->getValue());
        $this->assertSame('EUR', $monetarySummationTotal->getCurrency());

        $product = $lineItem->getProduct();
        $this->assertSame('TB100A4', $product->getSellerAssignedID());
        $this->assertSame('Trennblätter A4', $product->getName());
    }

}
