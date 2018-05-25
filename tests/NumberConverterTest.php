<?php

namespace Test;

use Converter\NumberConverter;
use PHPUnit\Framework\TestCase;

class NumberConverterTest extends TestCase
{
    private $converter;

    public function testSingles()
    {
        $this->converter = new NumberConverter('One');
        $this->assertEquals(1, $this->converter->toInt());

        $this->converter = new NumberConverter('Two');
        $this->assertEquals(2, $this->converter->toInt());
    }

    public function testTeens()
    {
        $this->converter = new NumberConverter('Ten');
        $this->assertEquals(10, $this->converter->toInt());

        $this->converter = new NumberConverter('Eighteen');
        $this->assertEquals(18, $this->converter->toInt());
    }

    public function testTens()
    {
        $this->converter = new NumberConverter('Twenty');
        $this->assertEquals(20, $this->converter->toInt());

        $this->converter = new NumberConverter('ninety');
        $this->assertEquals(90, $this->converter->toInt());
    }

    public function testNumbersBelowHundred()
    {
        $this->converter = new NumberConverter('Twenty four');
        $this->assertEquals(24, $this->converter->toInt());

        $this->converter = new NumberConverter('ninety five');
        $this->assertEquals(95, $this->converter->toInt());

        $this->converter = new NumberConverter('sixty six');
        $this->assertEquals('66', $this->converter->format());

        $this->converter = new NumberConverter('thirty one');
        $this->assertEquals(31, $this->converter->toInt());
    }

    public function testHundred()
    {
        $this->converter = new NumberConverter('hundred');
        $this->assertEquals(100, $this->converter->toInt());

        $this->converter = new NumberConverter('hundred ten');
        $this->assertEquals(110, $this->converter->toInt());

        $this->converter = new NumberConverter('three hundred fifty');
        $this->assertEquals(350, $this->converter->toInt());
        $this->assertEquals('350', $this->converter->format());
    }

    public function testThousand()
    {
        $this->converter = new NumberConverter('thousand');
        $this->assertEquals(1000, $this->converter->toInt());
        $this->assertEquals('1,000', $this->converter->format());

        $this->converter = new NumberConverter('two thousand six hundred sixty four');
        $this->assertEquals(2664, $this->converter->toInt());
        $this->assertEquals('2,664', $this->converter->format());

        $this->converter = new NumberConverter('two hundred thousand six hundred sixty four');
        $this->assertEquals(200664, $this->converter->toInt());
        $this->assertEquals('200,664', $this->converter->format());

        $this->converter = new NumberConverter('hundred twenty four thousand three hundred fifty');
        $this->assertEquals(124350, $this->converter->toInt());
        $this->assertEquals('124,350', $this->converter->format());
    }
}
