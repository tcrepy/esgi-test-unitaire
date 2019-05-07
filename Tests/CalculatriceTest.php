<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CalculatriceTest extends TestCase
{
    /**
     * @var Calculatrice
     */
    protected $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculatrice();
    }

    public function testAdd(): void
    {
        $result = $this->calculator->add(5, 3);
        $this->assertEquals(8, $result);
    }

    public function testDivisionParZero()
    {
        $this->expectException(Exception::class);
        $this->calculator->div(3,0);
    }

    public function testAvgEquals(): void
    {
        $array = [12, 11, 10];
        $result = $this->calculator->avg($array);
        $this->assertEquals(11, $result);
    }

    public function testAvgNotEquals(): void
    {
        $array = [12, 11, 10];
        $result = $this->calculator->avg($array);
        $this->assertNotEquals(10, $result);
    }
}