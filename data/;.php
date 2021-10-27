<?php
declare(strict_types=1);

namespace Landingi\SharedKernel\Unit\Infrastructure\Wfirma;

use Landingi\Domain\Bookkeeping\InvoiceNumber;
use Landingi\Domain\Currency;
use Landingi\Domain\Money;
use Landingi\Infrastructure\Wfirma\RequestFactory;
use Landingi\Infrastructure\Wfirma\Response\WfirmaInvoice;
use Landingi\Infrastructure\Wfirma\ResponseFactory;
use Landingi\Infrastructure\Wfirma\Wfirma;
use Landingi\Infrastructure\Wfirma\WfirmaApi;
use Landingi\SharedKernel\Unit\Fake\FakeLogger;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class WfirmaTest extends TestCase
{
    use ProphecyTrait;

    private Wfirma $wfirma;

    /**
     * @var WfirmaApi|ObjectProphecy
     */
    private $api;

    public function setUp(): void
    {
        $this->api = $this->prophesize(WfirmaApi::class);
        $this->wfirma = new Wfirma(
            $this->api->reveal(),
            new RequestFactory(),
            new ResponseFactory(),
            new FakeLogger()
        );
    }

    public function testNotFoundInvoiceByNumber(): void
    {
        $this->expectException(\Landingi\Infrastructure\Wfirma\Exception\InvoiceNotFound::class);
        $this->api->findInvoice(Argument::any())->willReturn([]);
        $this->wfirma->findInvoiceByNumber(new InvoiceNumber('FV 09/2120'));
    }

    public function testFindInvoiceByNumber(): void
    {
        $this->api->findInvoice($this->buildRequestXml())->willReturn([
            'invoices' => [
                [
                    'invoice' => [
                        'id' => 'id',
                        'fullnumber' => 'FV 09/2120',
                        'total' => '-100.00',
                        'currency' => 'PLN',
                        'paymentmethod' => 'transfer',
                        'paymentdate' => '2018-05-01',
                        'created' => '2018-05-01',
                        'modified' => '2018-05-01',
                    ],
                ],
            ],
        ]);

        self::assertEquals(
            $this->wfirma->findInvoiceByNumber(new InvoiceNumber('FV 09/2120')),
            new WfirmaInvoice(
                'id',
                'FV 09/2120',
                new Money(-100.00, Currency::pln()),
                'transfer',
                '2018-05-01',
                '2018-05-01',
                '2018-05-01'
            )
        );
    }

    private function buildRequestXml(): string
    {
        return (string) (new RequestFactory())->buildFindInvoice(new InvoiceNumber('FV 09/2120'))->asXML();
    }
}
