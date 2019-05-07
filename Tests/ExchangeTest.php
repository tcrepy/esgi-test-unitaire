<?php
namespace tests;

use Exchange;
use PHPUnit\Framework\TestCase;
use Product;
use User;

class ExchangeTest extends TestCase
{
    /** @var Exchange $exchange */
    private $exchange;

    protected function setUp(): void
    {
        $this->exchange = new Exchange();

        /** @var User|\PHPUnit_Framework_MockObject_MockObject $owner */
        $owner = $this->createMock(User::class);
        $owner->expects($this->any())->method("isValid")->willReturn(true);

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $product */
        $product = $this->createMock(Product::class);
        $product->expects($this->any())->method("isValid")->willReturn(true);
        $product->expects($this->any())->method("getOwner")->willReturn($owner);

        /** @var User|\PHPUnit_Framework_MockObject_MockObject $receiver */
        $receiver = $this->createMock(User::class);
        $receiver->expects($this->any())->method("isValid")->willReturn(true);
        $receiver->expects($this->any())->method("getAge")->willReturn("17");

        /** @var DatabaseConnection|\PHPUnit_Framework_MockObject_MockObject $dbConnection */
        $dbConnection = $this->createMock(\DBConnexion::class);
        $dbConnection->expects($this->any())->method("save")->willReturn(true);

        /** @var EmailSender|\PHPUnit_Framework_MockObject_MockObject $emailSender */
        $emailSender = $this->createMock(\EmailSender::class);
        $emailSender->expects($this->any())->method("sendEmail")->willReturn(true);
        $emailSender->expects($this->any())->method("getMail")->willReturn("test@gmail.com");

        $this->exchange
            ->setProduct($product)
            ->setReceiver($receiver)
            ->setStartDate((new \DateTime())->add(new \DateInterval("PT1H")))
            ->setEndDate((new \DateTime())->add(new \DateInterval("PT2H")))
            ->setDBConnexion($dbConnection)
            ->setMailSender($emailSender);
    }

    protected function tearDown(): void
    {
        $this->exchange = null;
    }

    /**
     * @return Exchange
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @covers Exchange::save()
     */
    public function testSuccessSave()
    {
        $this->assertTrue($this->getExchange()->save());
    }

    /**
     * @covers Exchange::isValid()
     * @covers Exchange::getEndDate()
     * @covers Exchange::getStartDate()
     */
    public function testDates()
    {
        $this->assertGreaterThan($this->getExchange()->getStartDate(), $this->getExchange()->getEndDate());
        $this->assertTrue($this->getExchange()->isValid());
    }

    /**
     * @covers Exchange::save()
     * @covers Exchange::getEndDate()
     * @covers Exchange::getStartDate()
     */
    public function testIsNotSavedBecauseEndDateLesserThanStartDate()
    {
        $this->getExchange()
            ->setStartDate((new \DateTime())->add(new \DateInterval("PT2H")))
            ->setEndDate((new \DateTime())->add(new \DateInterval("PT1H")));
        $this->assertFalse($this->getExchange()->save());
    }

    /**
     * @covers Exchange::save()
     * @covers Exchange::getStartDate()
     */
    public function testIsNotSavedBecauseStartDateLesserThanNow()
    {
        $this->getExchange()
            ->setStartDate((new \DateTime())->sub(new \DateInterval("PT2H")));
        $this->assertFalse($this->getExchange()->save());
    }
}