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
  </rsm:SpecifiedSupplyChainTradeTransaction>
</rsm:CrossIndustryDocument>

XML;

        $doc = new \Easybill\ZUGFeRD\Model\Document();
        $doc->getHeader()
            ->setId('RE1337')
            ->setName('RECHNUNG')
            ->addDate(new \Easybill\ZUGFeRD\Model\Date('20130305', 102))
            ->addNote(new \Easybill\ZUGFeRD\Model\Note('Test Node 1'))
            ->addNote(new \Easybill\ZUGFeRD\Model\Note('Test Node 2'));

        $doc->getTrade()
            ->setAgreement(new \Easybill\ZUGFeRD\Model\Trade\Agreement(
                    new \Easybill\ZUGFeRD\Model\Trade\TradeParty('Lieferant GmbH',
                        new \Easybill\ZUGFeRD\Model\Address('80333', 'Lieferantenstraße 20', null, 'München', 'DE'),
                        array(
                            new \Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration('FC', '201/113/40209'),
                            new \Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration('VA', 'DE123456789')
                        )
                    ),
                    new \Easybill\ZUGFeRD\Model\Trade\TradeParty('Kunden AG Mitte',
                        new \Easybill\ZUGFeRD\Model\Address('69876', 'Hans Muster', 'Kundenstraße 15', 'Frankfurt', 'DE'),
                        array()
                    )
                )
            )->setDelivery(new \Easybill\ZUGFeRD\Model\Trade\Delivery('20130305', 102));


        $builder = \Easybill\ZUGFeRD\Builder::create();
        $xml = $builder->getXML($doc);

        var_dump($xml);
        $this->assertSame($zugferdXML, $xml);

    }
}
